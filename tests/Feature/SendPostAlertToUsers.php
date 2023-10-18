<?php

namespace Tests\Feature;

use App\Mail\SendPostMail;
use App\Models\EmailLog;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\SendEmailToUser;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendPostAlertToUsers extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $website;
    protected $posts;

    public function setUp(): void
    {
        parent::setUp();
        Mail::fake();
        $this->user = User::factory()->create([
            'name' => 'A',
            'email' => 'abc@gmail.com'
        ]);
        $this->website = Website::factory()->create([
            'name' => 'B'
        ]);
        Subscription::factory()->create([
            'website_id' => $this->website->id,
            'user_id' => $this->user->id
        ]);
        $this->posts = Post::factory()->create([
            'website_id' => $this->website->id,
            'title' => 'test title',
            'description' => 'test description'
        ]);
    }

    /** @test */
    public function send_available_post_to_users(): void
    {
        SendEmailToUser::sendEmailNotification();
        $subscriptionCount = Subscription::where('website_id',$this->website->id)
            ->where('user_id',$this->user->id)
            ->get()->count();
        $this->assertEquals(1, $subscriptionCount);
        $this->assertDatabaseHas('email_logs', [
            'post_id' => $this->user->id,
            'user_id' => $this->posts->id
        ]);
        Mail::assertQueued(SendPostMail::class, function (SendPostMail $mail){
            $this->assertEquals($mail->subject, $this->posts->title);
            $this->assertEquals($mail->body, $this->posts->description);
            return $mail->assertTo($this->user->email);
        });
    }

    /** @test */
    public function not_sending_duplicate_emails(): void{
        for ($x = 0; $x <= 10; $x++) {
            SendEmailToUser::sendEmailNotification();
        }

        $subscriptionCount = EmailLog::all()->count();
        $this->assertEquals(1, $subscriptionCount);
        Mail::assertQueued(SendPostMail::class,1);
    }
}

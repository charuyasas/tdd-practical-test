<?php

namespace Tests\Feature;

use App\Jobs\SendPostEmailJob;
use App\Mail\SendPostMail;
use App\Models\Posts;
use App\Models\Subscription;
use App\Models\Users;
use App\Models\Websites;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\SendEmailToUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class SendPostAlertToUsers extends TestCase
{
    use RefreshDatabase;

    private $user,$website,$posts;
    public function setUp(): void
    {
        parent::setUp();

        Mail::fake();

        $this->user = Users::factory()->create(['name' => 'A', 'email' => 'abc@gmail.com']);
        $this->website = Websites::factory()->create(['name' => 'B']);
        Subscription::factory()->create([
            'website_id' => $this->website->id,
            'user_id' => $this->user->id
        ]);
        $this->posts = Posts::factory()->create([
            'website_id' => $this->website->id,
            'title' => 'test title',
            'description' => 'test description'
        ]);
    }
    public function test_SendAvailablePostToUsers(): void
    {
        SendEmailToUser::sendEmailNotification();

        $subscriptionCount = DB::table('subscriptions')
            ->where('website_id',$this->website->id)
            ->where('user_id',$this->user->id)
            ->get()->count();
        $this->assertEquals(1, $subscriptionCount);
        $this->assertDatabaseHas('email_logs', [
            'post_id' => $this->user->id,
            'user_id' => $this->posts->id
        ]);

        Mail::assertSent(SendPostMail::class, function (SendPostMail $mail){
            $this->assertEquals($mail->subject, $this->posts->title);
            $this->assertEquals($mail->body, $this->posts->description);
            return $mail->assertTo($this->user->email);
        });
    }

    public function test_NotSendingDuplicateEmails(): void{
        for ($x = 0; $x <= 10; $x++) {
            SendEmailToUser::sendEmailNotification();
        }

        $subscriptionCount = DB::table('email_logs')->get()->count();
        $this->assertEquals(1, $subscriptionCount);
        Mail::assertSent(SendPostMail::class,1);
    }

    public function test_SendEmailsThroughQueue(): void
    {
        Queue::fake();
        SendEmailToUser::sendEmailNotification();
        Queue::assertPushed(SendPostEmailJob::class, 1);
    }
}

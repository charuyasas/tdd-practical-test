<?php

namespace Tests\Feature;

use App\Mail\SendPostMail;
use App\Models\EmailLog;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;
use App\UseCases\SendEmailToUserUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendPostAlertToUsers extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Website $website;
    private Post $posts;

    public function setUp(): void
    {
        parent::setUp();
        Mail::fake();
        $this->user = User::factory()->create([
            'name' => 'A',
            'email' => 'abc@gmail.com',
            'password' => bcrypt('123456')
        ]);
        $this->website = Website::factory()->create([
            'name' => 'B'
        ]);
        $this->actingAs($this->user);
        Subscription::factory()->create([
            'website_id' => $this->website->id,
            'user_id' => $this->user->id
        ]);
        $this->posts = Post::factory()->create([
            'website_id' => $this->website->id,
            'user_id' => $this->user->id,
            'title' => 'test title',
            'description' => 'test description'
        ]);
    }

    /** @test */
    public function send_available_post_to_users(): void
    {
        (new SendEmailToUserUseCase)->execute();

        $subscriptionCount = Subscription::where('website_id', $this->website->id)
            ->where('user_id', $this->user->id)
            ->get()->count();
        $this->assertEquals(1, $subscriptionCount);
        $this->assertDatabaseHas('email_logs', [
            'post_id' => $this->user->id,
            'user_id' => $this->posts->id
        ]);

        Mail::assertQueued(SendPostMail::class, function ($mail) {
            $this->assertEquals($mail->title, $this->posts->title);
            $this->assertEquals($mail->content, $this->posts->description);
            return $mail->assertTo($this->user->email);
        });
    }

    /** @test */
    public function not_sending_duplicate_emails(): void
    {
        for ($x = 0; $x <= 10; $x++) {
            (new SendEmailToUserUseCase)->execute();
        }

        $subscriptionCount = EmailLog::all()->count();

        $this->assertEquals(1, $subscriptionCount);
        Mail::assertQueued(SendPostMail::class, 1);
    }
}

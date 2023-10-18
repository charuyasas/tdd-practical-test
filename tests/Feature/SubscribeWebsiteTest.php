<?php

namespace Tests\Feature;

use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscribeWebsiteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_user_subscribe_website(): void
    {
        $this->withoutExceptionHandling();
        $subscribe = Subscription::factory()->create();
        $this->postJson(
            route('subscribe.store'),
            [
                'website_id' => $subscribe->website_id,
                'user_id' => $subscribe->user_id
            ])->assertCreated()->json();
        $this->assertDatabaseHas(
            'subscriptions',
            [
                'website_id' => $subscribe->website_id,
                'user_id' => $subscribe->user_id
            ]);
    }
}

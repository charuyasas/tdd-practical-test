<?php

namespace Tests\Feature;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class SubscribeWebsiteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_subscribe_website(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $subscribe = Subscription::factory()->make();

        $this->assertEquals($user->id, Auth::user()->id);
        $this->postJson(
            route('subscribe.store'),
            [
                'websiteId' => $subscribe->website_id,
                'userId' => Auth::user()->id
            ])->assertCreated()->json();

        $this->assertDatabaseHas(
            'subscriptions',
            [
                'website_id' => $subscribe->website_id,
                'user_id' => Auth::user()->id
            ]);
    }
}

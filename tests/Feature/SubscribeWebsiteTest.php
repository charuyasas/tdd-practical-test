<?php

namespace Tests\Feature;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class SubscribeWebsiteTest extends TestCase
{
    use RefreshDatabase;

    public User $user;
    public Website $website;
    public Subscription $subscribe;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
        $this->website = Website::factory()->create([
            'name' => 'B'
        ]);
        $this->subscribe = Subscription::factory()->create([
            'website_id' => $this->website->id
        ]);
    }

    /** @test */
    public function user_subscribe_website(): void
    {
        $this->postJson(
            route('website.subscribe', ['website' => $this->website->id]), [])->assertCreated();

        $this->assertDatabaseHas(
            'subscriptions',
            [
                'website_id' => $this->subscribe->website_id,
                'user_id' => Auth::user()->id
            ]);
    }
}

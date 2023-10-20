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
            route('subscribe.store'),
            [
                'website_id' => $this->subscribe->website_id
            ])->assertCreated()->json();

        $this->assertDatabaseHas(
            'subscriptions',
            [
                'website_id' => $this->subscribe->website_id,
                'user_id' => Auth::user()->id
            ]);
    }

    /**
     * @test
     * @dataProvider requiredValidationProvider
     */
    public function it_validates_form($formInput, $formInputValue, $massage)
    {
        $response = $this->postJson(
            route(
                'subscribe.store',
                [$formInput => $formInputValue]
            ),
        );

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([$formInput => [$massage]]);
    }

    public static function requiredValidationProvider(): array
    {
        return [
            ['website_id', '', "The website id field is required."],
            ['website_id', null, "The website id field is required."],
            ['website_id', 'abc', "The website id field must be an integer."]
        ];
    }
}

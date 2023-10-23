<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    public User $user;
    public Website $website;
    public Post $post;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
        $this->website = Website::factory()->create();
        $this->post = Post::factory()->make();
    }

    /** @test */
    public function store_new_post()
    {
        $this->assertEquals($this->user->id, Auth::user()->id);
        $this->postJson(
            route('posts.store', ['website' => $this->website->id]),
            [
                'website_id' => $this->website->id,
                'user_id' => Auth::user()->id,
                'title' => $this->post->title,
                'description' => $this->post->description
            ])->assertCreated();

        $this->assertDatabaseHas(
            'posts',
            [
                'website_id' => $this->website->id,
                'user_id' => Auth::user()->id,
                'title' => $this->post->title,
                'description' => $this->post->description
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
                'posts.store',
                [$formInput => $formInputValue,'website' => $this->website->id]
            ),
        );

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([$formInput => [$massage]]);
    }

    public static function requiredValidationProvider(): array
    {
        return [
            ['title', '', "The title field is required."],
            ['title', null, "The title field is required."],
            ['description', '', "The description field is required."],
            ['description', null, "The description field is required."],
        ];
    }
}

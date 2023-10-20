<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    public User $user;
    public Post $post;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
        $this->post = Post::factory()->make();
    }

    /** @test */
    public function store_new_post()
    {
        $this->assertEquals($this->user->id, Auth::user()->id);
        $this->postJson(
            route('posts.store'),
            [
                'website_id' => $this->post->website_id,
                'user_id' => Auth::user()->id,
                'title' => $this->post->title,
                'description' => $this->post->description
            ])->assertCreated()->json();

        $this->assertDatabaseHas(
            'posts',
            [
                'website_id' => $this->post->website_id,
                'user_id' => Auth::user()->id,
                'title' => $this->post->title,
                'description' => $this->post->description
            ]);
    }

    /** @test */
    public function validate_empty_record()
    {
        $this->postJson(
            route('posts.store'),
            [
                'website_id' => $this->post->website_id,
                'title' => $this->post->title,
                'description' => $this->post->description
            ])->assertUnprocessable()->json();
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
            ['website_id', 'abc', "The website id field must be an integer."],
            ['title', '', "The title field is required."],
            ['title', null, "The title field is required."],
            ['description', '', "The description field is required."],
            ['description', null, "The description field is required."],
        ];
    }
}

<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function store_new_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $postList = Post::factory()->make();

        $this->assertEquals($user->id, Auth::user()->id);
        $this->postJson(
            route('posts.store'),
            [
                'websiteId' => $postList->website_id,
                'userId' => Auth::user()->id,
                'title' => $postList->title,
                'description' => $postList->description
            ])->assertCreated()->json();

        $this->assertDatabaseHas(
            'posts',
            [
                'website_id' => $postList->website_id,
                'user_id'=>Auth::user()->id,
                'title' => $postList->title,
                'description' => $postList->description
            ]);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function store_new_post()
    {
        $postList = Post::factory()->make();

        $this->postJson(
            route('posts.store'),
            [
                'websiteId' => $postList->website_id,
                'title' => $postList->title,
                'description' => $postList->description
            ])->assertCreated()->json();

        $this->assertDatabaseHas(
            'posts',
            [
                'website_id' => $postList->website_id,
                'title' => $postList->title,
                'description' => $postList->description
            ]);
    }
}

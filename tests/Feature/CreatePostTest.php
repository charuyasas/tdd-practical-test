<?php

namespace Tests\Feature;

use App\Models\Posts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;
    public function test_StoreNewPost()
    {
        $postList = Posts::factory()->create();
        $this->postJson(
            route('posts.store'),
            [
                'website_id' => $postList->website_id,
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

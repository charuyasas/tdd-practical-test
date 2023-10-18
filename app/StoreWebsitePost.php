<?php

namespace App;

use App\DTOs\PostDTO;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;

class StoreWebsitePost
{
    public static function storeWebsitePost(PostDTO $postDTO){
        $posts = new Post();
        $posts->website_id=$postDTO->website_id;
        $posts->title=$postDTO->title;
        $posts->description=$postDTO->description;
        $posts->save();
        return $posts;
    }
}

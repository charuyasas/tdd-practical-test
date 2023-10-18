<?php

namespace App\Http\Controllers;

use App\DTOs\PostDTO;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WebsitePostsController extends Controller
{
    public static function store(StorePostRequest $request){
        $postDTO = new PostDTO($request->website_id,$request->title,$request->description);
        $posts = new Post();
        $posts->website_id=$postDTO->website_id;
        $posts->title=$postDTO->title;
        $posts->description=$postDTO->description;
        $posts->save();
        return $posts;
    }
}

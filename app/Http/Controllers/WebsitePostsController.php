<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\StoreWebsitePost;
use Illuminate\Routing\Controller;

class WebsitePostsController extends Controller
{
    public static function store(StorePostRequest $request){
        return StoreWebsitePost::storeWebsitePost($request->getPostDTO());
    }
}

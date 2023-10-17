<?php

namespace App;

use App\Models\Posts;
use Illuminate\Http\Request;

class WebsitePosts
{
    public static function store(Request $request){
        return Posts::create([
            'website_id'=>$request->website_id,
            'title'=>$request->title,
            'description'=>$request->description,
            ]);
    }
}

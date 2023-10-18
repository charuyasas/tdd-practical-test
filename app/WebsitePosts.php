<?php

namespace App;

use App\Models\Posts;
use Illuminate\Http\Request;

class WebsitePosts
{
    public static function store(Request $request){
        $request->validate([
            'website_id' => ['required'],
            'title' => ['required'],
            'description' => ['required']
        ]);
        $posts = new Posts();
        $posts->website_id=$request->website_id;
        $posts->title=$request->title;
        $posts->description=$request->description;
        $posts->save();
        return $posts;
    }
}

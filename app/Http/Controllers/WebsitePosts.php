<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;

class WebsitePosts extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['website_id' => ['required'], 'title' => ['required'], 'description' => ['required']]);
        return Posts::create($request->all());
    }
}

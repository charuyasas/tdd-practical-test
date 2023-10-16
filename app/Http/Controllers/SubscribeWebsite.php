<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscribeWebsite extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['website_id' => ['required'], 'user_id' => ['required']]);
        return Subscription::create($request->all());
    }
}

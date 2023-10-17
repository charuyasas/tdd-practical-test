<?php

namespace App;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscribeWebsite
{
    public static function store(Request $request){
        return Subscription::create([
            'website_id'=>$request->website_id,
            'user_id'=>$request->user_id,
        ]);
    }
}

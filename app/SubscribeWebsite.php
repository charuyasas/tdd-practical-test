<?php

namespace App;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscribeWebsite
{
    public static function store(Request $request){
        $request->validate([
            'website_id' => ['required'],
            'user_id' => ['required']
        ]);
        $subscribe = new Subscription();
        $subscribe->website_id = $request->website_id;
        $subscribe->user_id = $request->user_id;
        $subscribe->save();
        return $subscribe;
    }
}

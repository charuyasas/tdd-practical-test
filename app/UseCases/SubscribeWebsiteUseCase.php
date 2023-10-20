<?php

namespace App\UseCases;

use App\Commands\SubscribeUserCommand;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;
use App\Requests\SubscribeWebsiteRequest;

class SubscribeWebsiteUseCase
{
    public function execute(User $user, SubscribeWebsiteRequest $request)
    {
        $subscribe = new Subscription();
        $subscribe->website_id = $request->websiteId;
        $subscribe->user_id = $user->id;
        $subscribe->save();
        return $subscribe;
    }
}

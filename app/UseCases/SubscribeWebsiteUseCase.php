<?php

namespace App\UseCases;

use App\Commands\SubscribeUserCommand;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;
use App\Requests\SubscribeWebsiteRequest;

class SubscribeWebsiteUseCase
{
    public function execute(User $user, Website $website)
    {
        $subscribe = new Subscription();
        $subscribe->website_id = $website->id;
        $subscribe->user_id = $user->id;
        $subscribe->save();
        return $subscribe;
    }
}

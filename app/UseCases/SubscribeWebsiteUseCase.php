<?php

namespace App\UseCases;

use App\Commands\SubscribeUserCommand;
use App\Models\Subscription;
use App\Models\User;

class SubscribeWebsiteUseCase
{
    public function execute(User $user,SubscribeUserCommand $command)
    {
        $subscribe = new Subscription();
        $subscribe->website_id = $command->websiteId;
        $subscribe->user_id = $user->id;
        $subscribe->save();
        return $subscribe;
    }
}

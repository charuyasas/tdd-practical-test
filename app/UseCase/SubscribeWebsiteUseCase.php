<?php

namespace App\UseCase;

use App\Commands\SubscribeUserCommand;
use App\Models\Subscription;

class SubscribeWebsiteUseCase
{
    public function execute(SubscribeUserCommand $commandData)
    {
        $subscribe = new Subscription();
        $subscribe->website_id = $commandData->websiteId;
        $subscribe->user_id = $commandData->userId;
        $subscribe->save();
        return $subscribe;
    }
}

<?php

namespace App;

use App\DTOs\SubscribeDTO;
use App\Models\Subscription;

class SubscribeWebsite
{
    public function storeUserSubscription(SubscribeDTO $subscribeDTO)
    {
        $subscribe = new Subscription();
        $subscribe->website_id = $subscribeDTO->websiteId;
        $subscribe->user_id = $subscribeDTO->userId;
        $subscribe->save();
        return $subscribe;
    }
}

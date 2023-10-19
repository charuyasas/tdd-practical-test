<?php

namespace App\Commands;

class SubscribeUserCommand
{
    public function __construct(
        public int    $websiteId,
        public string $userId
    )
    {
    }
}

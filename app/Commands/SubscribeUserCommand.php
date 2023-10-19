<?php

namespace App\DTOs;

class SubscribeDTO
{
    public function __construct(
        public int    $websiteId,
        public string $userId
    )
    {
    }
}

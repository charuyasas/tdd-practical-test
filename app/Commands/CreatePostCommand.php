<?php

namespace App\Commands;

class CreatePostCommand
{
    public function __construct(
        public int    $websiteId,
        public int    $userId,
        public string $title,
        public string $description
    )
    {
    }
}

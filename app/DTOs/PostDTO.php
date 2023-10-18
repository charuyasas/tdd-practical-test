<?php

namespace App\DTOs;

class PostDTO
{
    public function __construct(
        public int $websiteId,
        public string $title,
        public string $description
    )
    {}

}

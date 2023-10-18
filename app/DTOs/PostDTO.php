<?php

namespace App\DTOs;

class PostDTO
{
    public function __construct(
        public int $website_id,
        public string $title,
        public string $description
    )
    {}
}

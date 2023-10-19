<?php

namespace App\Commands;

class PostCommand
{
    public function __construct(
        public int $websiteId,
        public string $title,
        public string $description
    )
    {}

}

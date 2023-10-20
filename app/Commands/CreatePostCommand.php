<?php

namespace App\Commands;

class CreatePostCommand
{
    public int $website_id;
    public int $user_id;
    public string $title;
    public string $description;
}

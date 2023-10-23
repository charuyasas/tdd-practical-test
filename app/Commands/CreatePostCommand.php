<?php

namespace App\Commands;

use App\Models\Website;

class CreatePostCommand
{
    public string $title;
    public string $description;
    public Website $website;
}


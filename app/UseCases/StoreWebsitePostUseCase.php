<?php

namespace App\UseCases;

use App\Commands\CreatePostCommand;
use App\Models\Post;
use App\Models\User;
use App\Models\Website;

class StoreWebsitePostUseCase
{
    public function execute(User $user, Website $website, CreatePostCommand $command)
    {
        $posts = new Post();
        $posts->user_id = $user->id;
        $posts->website_id = $website->id;
        $posts->title = $command->title;
        $posts->description = $command->description;
        $posts->save();

        return $posts;
    }
}

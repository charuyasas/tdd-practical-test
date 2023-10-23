<?php

namespace App\UseCases;

use App\Commands\CreatePostCommand;
use App\Models\Post;
use App\Models\User;
use App\Models\Website;

class StoreWebsitePostUseCase
{
    public function execute(User $user, CreatePostCommand $command)
    {
        $posts = new Post();
        $posts->website_id = $command->website->id;
        $posts->title = $command->title;
        $posts->description = $command->description;
        $posts->user_id = $user->id;
        $posts->save();

        return $posts;
    }
}

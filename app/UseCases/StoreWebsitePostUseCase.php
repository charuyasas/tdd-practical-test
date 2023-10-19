<?php

namespace App\UseCases;

use App\Commands\CreatePostCommand;
use App\Models\Post;
use App\Models\User;

class StoreWebsitePostUseCase
{
    public function execute(User $user, CreatePostCommand $commandData)
    {
        $posts = new Post();
        $posts->website_id = $commandData->websiteId;
        $posts->title = $commandData->title;
        $posts->description = $commandData->description;
        $posts->user_id = $user->id;
        $posts->save();
        return $posts;
    }
}

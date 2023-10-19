<?php

namespace App\UseCase;

use App\Commands\PostCommand;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;

class StoreWebsiteUseCase
{
    public function execute(PostCommand $commandData)
    {
        $posts = new Post();
        $posts->website_id = $commandData->websiteId;
        $posts->title = $commandData->title;
        $posts->description = $commandData->description;
        $posts->save();
        return $posts;
    }
}

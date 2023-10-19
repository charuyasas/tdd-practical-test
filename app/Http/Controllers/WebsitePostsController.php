<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Illuminate\Routing\Controller;

class WebsitePostsController extends Controller
{
    public static function store(StorePostRequest $request)
    {
        return (new \App\UseCase\StoreWebsiteUseCase)->execute($request->commandData());
    }
}

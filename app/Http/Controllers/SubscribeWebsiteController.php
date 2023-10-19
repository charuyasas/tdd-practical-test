<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeWebsiteRequest;
use Illuminate\Routing\Controller;

class SubscribeWebsiteController extends Controller
{
    public static function store(SubscribeWebsiteRequest $request)
    {
        return (new \App\UseCase\SubscribeWebsiteUseCase)->execute($request->commandData());
    }
}

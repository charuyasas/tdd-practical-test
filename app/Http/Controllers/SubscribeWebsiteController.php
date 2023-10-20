<?php

namespace App\Http\Controllers;

use App\Requests\SubscribeWebsiteRequest;
use App\UseCases\SubscribeWebsiteUseCase;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SubscribeWebsiteController extends Controller
{
    public function store(SubscribeWebsiteRequest $request)
    {
        return (new SubscribeWebsiteUseCase())->execute(Auth::user(), $request);
    }
}

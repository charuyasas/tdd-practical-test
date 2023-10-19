<?php

namespace App\Http\Controllers;

use App\Requests\StorePostRequest;
use App\UseCases\StoreWebsitePostUseCase;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class WebsitePostsController extends Controller
{
    public function store(StorePostRequest $request)
    {
        return (new StoreWebsitePostUseCase())->execute(Auth::user(),$request->command());
    }
}

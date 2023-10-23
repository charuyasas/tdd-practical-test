<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Requests\StorePostRequestAuthorized;
use App\UseCases\StoreWebsitePostUseCase;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class WebsitePostsController extends Controller
{
    public function store(StorePostRequestAuthorized $request, StoreWebsitePostUseCase $storeWebsitePostUseCase, Website $website)
    {
        return $storeWebsitePostUseCase->execute(Auth::user(), $request->command());
    }
}

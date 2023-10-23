<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Requests\StorePostRequest;
use App\UseCases\StoreWebsitePostUseCase;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class WebsitePostsController extends Controller
{
    public function store(StorePostRequest $request, StoreWebsitePostUseCase $storeWebsitePostUseCase, Website $website)
    {
        return $storeWebsitePostUseCase->execute(Auth::user(), $website, $request->command());
    }
}

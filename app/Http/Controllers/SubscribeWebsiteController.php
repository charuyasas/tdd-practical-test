<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Requests\SubscribeWebsiteRequest;
use App\UseCases\SubscribeWebsiteUseCase;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SubscribeWebsiteController extends Controller
{
    public function store(SubscribeWebsiteRequest $request, SubscribeWebsiteUseCase $subscribeWebsiteUseCase)
    {
        $website = Website::all()->find($request->website_id);
        return $subscribeWebsiteUseCase->execute(Auth::user(), $website);
    }
}

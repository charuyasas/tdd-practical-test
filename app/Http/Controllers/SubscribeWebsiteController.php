<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\UseCases\SubscribeWebsiteUseCase;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SubscribeWebsiteController extends Controller
{
    public function store(SubscribeWebsiteUseCase $subscribeWebsiteUseCase, Website $website)
    {
        return $subscribeWebsiteUseCase->execute(Auth::user(), $website);
    }
}

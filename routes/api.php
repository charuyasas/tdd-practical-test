<?php

use Illuminate\Support\Facades\Route;

Route::post('websites/{website}/posts', [\App\Http\Controllers\WebsitePostsController::class, 'store'])->name('posts.store');
Route::post('websites/{website}/subscribe', [\App\Http\Controllers\SubscribeWebsiteController::class, 'store'])->name('website.subscribe');

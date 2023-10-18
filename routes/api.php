<?php

use Illuminate\Support\Facades\Route;

Route::post('create_post', [\App\Http\Controllers\WebsitePostsController::class, 'store'])->name('posts.store');
Route::post('subscribe_website', [\App\Http\Controllers\SubscribeWebsiteController::class, 'store'])->name('subscribe.store');

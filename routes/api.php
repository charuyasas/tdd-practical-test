<?php

use Illuminate\Support\Facades\Route;

Route::post('create_post', [\App\WebsitePosts::class, 'store'])->name('posts.store');
Route::post('subscribe_website', [\App\SubscribeWebsite::class, 'store'])->name('subscribe.store');

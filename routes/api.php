<?php

use Illuminate\Support\Facades\Route;

Route::post('create_post', [\App\Http\Controllers\WebsitePosts::class, 'store'])->name('posts.store');
Route::post('subscribe_website', [\App\Http\Controllers\SubscribeWebsite::class, 'store'])->name('subscribe.store');

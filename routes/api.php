<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\SubscriberController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/post', [PostController::class, 'create'])->name('post.create');
Route::post('/website', [WebsiteController::class, 'create'])->name('website.create');
Route::post('/subscribe', [SubscriberController::class, 'create'])->name('subscriber.create');
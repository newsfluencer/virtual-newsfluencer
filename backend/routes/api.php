<?php

use App\Facades\News;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use function Pest\Laravel\json;

Route::get('articles', [ArticleController::class, 'index']);
Route::get('articles/{article}', [ArticleController::class, 'show']);

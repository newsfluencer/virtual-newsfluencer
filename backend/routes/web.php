<?php

use App\Facades\News;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $articles = News::getArticles();
    dd($articles['articles']['results']);
});

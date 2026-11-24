<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed getTopHeadlines()
 * @method static mixed get(string $endpoint, array $parameters = [])
 *
 * @see \App\Services\News
 */
class News extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'news';
    }
}

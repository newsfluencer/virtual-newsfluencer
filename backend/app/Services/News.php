<?php

namespace App\Services;

use App\Traits\Methods;

class News
{
    use Methods;

    public function getArticles()
    {
        return $this->get('/article/getArticles', [
            'lang' => 'nld',
            'articlesCount' => 10,
        ]);
    }
}

<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait Methods
{
    private string $baseUrl;

    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.news.base_url');
        $this->apiKey = config('services.news.api_key');
    }

    public function get(string $endpoint, array $parameters = [])
    {
        $query = array_merge([
            'apiKey' => $this->apiKey,
        ], $parameters);

        return Http::get($this->baseUrl.$endpoint, $query)->json();
    }
}

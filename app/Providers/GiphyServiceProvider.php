<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class GiphyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    public function searchGifs($q, $limit, $offset)
    {
        $url = config('giphy.api_key').'search';

        $response = Http::get($url, [
            'api_key' => config('giphy.api_key'),
            'q' => $q,
            'limit' => $limit,
            'offset' => $offset
        ]);

        return $response;
    }

    public function searchGifById($id) 
    {
        $url = config('giphy.api_key').$id;

        $response = Http::get($url, [
            'api_key' => config('giphy.api_key'),
        ]);

        return $response;
    }
}

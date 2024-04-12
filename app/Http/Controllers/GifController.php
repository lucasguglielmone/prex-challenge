<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Gif;
use App\Models\Favorite;
//use App\Providers\GiphyServiceProvider;
use App\Models\ServiceInteraction;
use Illuminate\Support\Facades\Auth;


class GifController extends Controller
{
    //protected $giphyService;

    public function __construct()
    {
        //$this->giphyService = new GiphyServiceProvider($this);
    }

    public function index(Request $request)
    {
        return 'Index method ok';
    }

    public function show($id)
    {
        // Implementa lógica para mostrar un GIF específico por su ID
    }

    public function store(Request $request)
    {
        // Implementa lógica para almacenar un nuevo GIF
    }

    public function update(Request $request, $id)
    {
        // Implementa lógica para actualizar un GIF existente
    }

    public function destroy($id)
    {
        // Implementa lógica para eliminar un GIF existente
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $limit = $request->input('limit', 25);
        $offset = $request->input('offset', 0);

        $response = $this->searchGifs($query, $limit, $offset);

        $responseCode = $response['meta']['status'];
        $responseData = json_encode($response['data']);

        $this->registerInteraction($request, 'search', $responseCode, $responseData);

        return $response['data'];
    }

    public function searchById(Request $request, $id)
    {
        $response = $this->searchGifById($id);

        $responseCode = $response['meta']['status'];
        $responseData = json_encode($response['data']);
        
        $this->registerInteraction($request, 'search', $responseCode, $responseData);

        return $response['data'];
    }

    public function favoriteGif(Request $request)
    {
        $request->validate([
            'gif_id' => 'required|string',
            'alias' => 'required|string',
            'user_id' => 'required|numeric',
        ]);

        $favorite = new Favorite();
        $favorite->user_id = $request->user_id;
        $favorite->gif_id = $request->gif_id;
        $favorite->alias = $request->alias;
        $favorite->save();
        
        return response()->json(['message' => 'GIF asignado como favorito correctamente']);
    }

    private function registerInteraction(Request $request, string $service, int $responseCode, string $responseData)
    {
        $interaction = new ServiceInteraction();
        $interaction->user_id = Auth::id();
        $interaction->service = $service;
        $interaction->request_body = $request->getContent();
        $interaction->response_code = $responseCode;
        $interaction->response_body = $responseData;
        $interaction->ip_address = $request->ip();
        $interaction->save();
    }

    // Pasar esto a  un service
    public function searchGifs($q, $limit, $offset)
    {
        $url = config('giphy.domain').'search';

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
        $url = config('giphy.domain').$id;

        $response = Http::get($url, [
            'api_key' => config('giphy.api_key'),
        ]);

        return $response;
    }
}

<?php

namespace App\Http\Services;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class ApiService
{
    public function api($repo){
        try{
            $response = Http::withToken(config('webapps.token'))
            ->get("https://api.github.com/repos/$repo/tags")->throw();
            return [
                'ok' => true,
                'content' => $response->json()[0]['name']
            ];
        }catch(\Exception $e){
            return [
                'ok' => false,
                'content' => 'Houve um erro'
            ];
        }
    }
}

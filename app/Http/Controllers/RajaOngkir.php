<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkir extends Controller
{
    public function getCities(Request $request)
    {
        $provinceId = $request->query('province');
        $response = Http::withHeaders([
            'key' => '360a5f29619bc971359e639ddc86ae40' // API Key RajaOngkir
        ])->get('https://api.rajaongkir.com/starter/city', [
            'province' => $provinceId
        ]);

        return $response->json();
    }
}

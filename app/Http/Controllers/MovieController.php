<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client();
        $token = $request->header('Authorization');

        try {
            $response = $client->get('http://localhost:8001/movie', [
                'headers' => [
                    'Authorization' => $token,
                    'Accept'        => 'application/json',
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            return response()->json($data, 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gateway could not reach Site 2',
                'details' => $e->getMessage()
            ], 502);
        }
    }
}
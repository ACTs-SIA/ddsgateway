<?php

namespace App\Http\Controllers;

use App\Models\MovUser;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Hash; 

class MovieUserController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $users = MovUser::all();
        $client = new Client();
        
        // 🕵️ Get the token from the current user's request
        $token = $this->request->header('Authorization');
        $result = [];

        foreach ($users as $user) {
            $movie = null;
            try {
                // 🕵️ ADDED: Passing the Authorization header to Site 2
                $response = $client->get("http://localhost:8001/movie/" . $user->movie_id, [
                    'headers' => ['Authorization' => $token]
                ]);
                $movie = json_decode($response->getBody()->getContents(), true);
            } catch (\Exception $e) {
                // This now catches both 401 (Unauthorized) and 404 (Not Found)
                $movie = ['error' => 'Movie not found or Unauthorized'];
            }

            $result[] = [
                'id' => $user->id,
                'username' => $user->username,
                'movie' => $movie
            ];
        }

        return response()->json($result, 200);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|unique:mov_users,username',
            'password' => 'required|string|min:6', // Changed to 6 for standard testing
            'movie_id' => 'required|numeric|min:1|not_in:0',
        ]);

        $client = new Client();
        $token = $request->header('Authorization');

        try {
            // 🕵️ ADDED: Passing the token to verify the movie exists
            $client->get("http://localhost:8001/movie/" . $request->movie_id, [
                'headers' => ['Authorization' => $token]
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Movie not found on Site 2'], 404);
        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        $user = MovUser::create($data);
        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = MovUser::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $client = new Client();
        $token = $this->request->header('Authorization');
        $movie = null;

        try {
            // 🕵️ ADDED: Passing the token
            $response = $client->get("http://localhost:8001/movie/" . $user->movie_id, [
                'headers' => ['Authorization' => $token]
            ]);
            $movie = json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            $movie = ['error' => 'Movie not found'];
        }

        return response()->json([
            'id' => $user->id,
            'username' => $user->username,
            'movie' => $movie
        ], 200);
    }

    public function update($id, Request $request)
    {
        $user = MovUser::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $this->validate($request, [
            'username' => 'string|unique:mov_users,username,' . $id,
            'password' => 'string|min:6',
            'movie_id' => 'required|numeric|min:1|not_in:0',
        ]);

        $client = new Client();
        $token = $request->header('Authorization');

        try {
            // 🕵️ ADDED: Passing the token
            $client->get("http://localhost:8001/movie/" . $request->movie_id, [
                'headers' => ['Authorization' => $token]
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Movie validation failed'], 404);
        }

        $data = $request->all();
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return response()->json($user, 200);
    }

    public function delete($id)
    {
        $user = MovUser::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted'], 200);
        }
        return response()->json(['message' => 'User not found'], 404);
    }
}
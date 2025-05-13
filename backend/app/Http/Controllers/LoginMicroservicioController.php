<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class LoginMicroservicioController extends Controller
{
    public function getAllLogins()
    {
        $url = 'http://localhost:8080/api/login/get';
        $response = Http::get($url);
        return response()->json($response->json(), $response->status());
    }

    public function getLoginById($id)
    {
        $url = "http://localhost:8080/api/login/get/{$id}";
        $response = Http::get($url);
        return response()->json($response->json(), $response->status());
    }

    public function createLogin(Request $request)
    {
        $url = "http://localhost:8080/api/login/create";
        $data = $request->only(['username', 'password']); 
        $response = Http::post($url, $data);
        return response()->json($response->json(), $response->status());
    }

    public function update(Request $request)
    {
        $url = "http://localhost:8080/api/login/update";
        $data = $request->only(['id', 'username', 'password']); 
        $response = Http::put($url, $data);
        return response()->json($response->json(), $response->status());
    }

    public function deleteLogin($id)
    {
        $url = "http://localhost:8080/api/login/delete/{$id}";
        $response = Http::delete($url);
        return response()->json($response->json(), $response->status());
    }
}

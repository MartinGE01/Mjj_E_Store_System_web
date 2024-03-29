<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class UserController extends Controller
{
    public function index()
    {
        // Obtiene el token de autenticación de la sesión
        $token = session('token');
    
        // Verifica si el token está presente en la sesión
        if ($token) {
            // Realiza la solicitud HTTP con el token de autenticación
            $response = Http::withToken($token)->get('https://prub.colegiohessen.edu.pe/api/users');
    
            // Verifica si la solicitud fue exitosa
            if ($response->successful()) {
                $usuarios = $response->json();
    
                // Retorna la vista 'usuarios.index' y pasa los datos de los usuarios como variable
                return view('user.usuario', ['usuarios' => $usuarios['data']]);
            } else {
                // Maneja el error si la solicitud no fue exitosa
                return response()->json(['error' => 'Error al obtener los datos de la API'], $response->status());
            }
        } else {
            // Maneja el caso donde no hay token de autenticación en la sesión
            return response()->json(['error' => 'No se encontró token de autenticación en la sesión'], 401);
        }
    }

}

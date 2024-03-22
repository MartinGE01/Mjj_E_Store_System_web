<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        try {
            $client = new Client();
            $response = $client->post('https://prub.colegiohessen.edu.pe/api/auth/login', [
                'form_params' => [
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            // Verificar si la autenticación fue exitosa
            if (isset($data['token'])) {
                // Autenticación exitosa, guardar el token en la sesión
                session(['token' => $data['token']]);
                return redirect()->route('bienvenido');
            } else {
                // Autenticación fallida, mostrar mensaje de error
                return redirect()->back()->withInput()->withErrors(['message' => 'Correo o contraseña incorrectos']);
            }
        } catch (ClientException $e) {
            // Captura el error de cliente (401 Unauthorized)
            if ($e->getResponse()->getStatusCode() === 401) {
                // Error de autenticación, mostrar mensaje de error
                return redirect()->back()->withInput()->withErrors(['message' => 'Correo o contraseña incorrectos']);
            } else {
                // Otro error, manejar según sea necesario
                // Por ejemplo, puedes registrar el error o mostrar un mensaje genérico de error
                return redirect()->back()->withInput()->withErrors(['message' => 'Ocurrió un error. Por favor, inténtalo de nuevo más tarde.']);
            }
        }
    }
}

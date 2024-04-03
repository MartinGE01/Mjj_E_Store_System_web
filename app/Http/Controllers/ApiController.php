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
                session(['departamento' => $data['data']['departamento']]);
                session(['usuario' => $data['data']['user']['name']]);
                session(['id' => $data['data']['user']['id']]);
                return redirect()->route('dashboard');
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
    public function logout()
{
    try {
        $client = new Client();
        $response = $client->get('https://prub.colegiohessen.edu.pe/api/auth/logout', [
            'headers' => [
                'Authorization' => 'Bearer ' . session('token'),
            ]
        ]);

        // Verificar si la respuesta es exitosa (código 200)
        if ($response->getStatusCode() === 200) {
            // Borrar el token de la sesión
            session()->forget('token');
            return redirect()->route('login');
        } else {
            // Mostrar mensaje de error si la respuesta no es exitosa
            return redirect()->back()->withErrors(['message' => 'Error al cerrar sesión. Por favor, inténtalo de nuevo más tarde.']);
        }
    } catch (ClientException $e) {
        // Manejar el error según sea necesario
        return redirect()->back()->withErrors(['message' => 'Ocurrió un error al cerrar sesión. Por favor, inténtalo de nuevo más tarde.']);
    }
}

}

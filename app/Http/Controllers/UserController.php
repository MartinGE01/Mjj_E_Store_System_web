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
    public function store(Request $request)
    {
        // Obtiene el token de autenticación de la sesión
        $token = session('token');

        // Verifica si el token está presente en la sesión
        if ($token) {
        // Realiza la solicitud HTTP con el token de autenticación
            $response = Http::withToken($token)->post('https://prub.colegiohessen.edu.pe/api/auth/register', [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'departamento_id' => $request->departamento_id,
            ]);

            // Verifica si la solicitud fue exitosa
            if ($response->successful()) {
                return redirect()->back()->with('success', 'Usuario creado satisfactoriamente');
            } else {
                // Maneja el error si la solicitud no fue exitosa
                return redirect()->back()->with('error', 'Error al crear el usuario');
            }
        } else {
            // Maneja el caso donde no hay token de autenticación en la sesión
            return response()->json(['error' => 'No se encontró token de autenticación en la sesión'], 401);
        }
    }
    public function destroy($id)
    {
        $token = session('token');
        
        if ($token) {
            $response = Http::withToken($token)->delete('https://prub.colegiohessen.edu.pe/api/users/' . $id);
            
            if ($response->successful()) {
                return redirect()->back()->with('success', 'Usuario eliminado satisfactoriamente');
            } else {
                return redirect()->back()->with('error', 'Error al eliminar el usuario');
            }
        } else {
            return redirect()->back()->with('error', 'No se encontró token de autenticación en la sesión');
        }
    }
    public function edit($id)
    {
        $token = session('token');
    
        if ($token) {
            $response = Http::withToken($token)->get('https://prub.colegiohessen.edu.pe/api/users/' . $id);
    
            if ($response->successful()) {
                $usuario = $response->json();
    
                // Retorna la vista 'usuarios.edit' y pasa los datos del usuario como variable
                return view('user.updatUser', ['usuario' => $usuario['data']]);
            } else {
                return redirect()->back()->with('error', 'Error al obtener los datos del usuario');
            }
        } else {
            return redirect()->back()->with('error', 'No se encontró token de autenticación en la sesión');
        }
    }

    public function udateUser(Request $request, $id)
    {
        $token = session('token');
        
        if ($token) {
            $response = Http::withToken($token)->put('https://prub.colegiohessen.edu.pe/api/users/' . $id, [
                'name' => $request->name,
                'email' => $request->email,
                'departamento_id' => $request->departamento_id,
            ]);
    
            if ($response->successful()) {
                return redirect()->back()->with('success', 'Usuario actualizado satisfactoriamente');
            } else {
                return redirect()->back()->with('error', 'Error al actualizar el usuario');
            }
        } else {
            return redirect()->back()->with('error', 'No se encontró token de autenticación en la sesión');
        }
    }
}

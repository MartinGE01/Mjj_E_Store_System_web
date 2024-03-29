<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ProductoController extends Controller
{
    public function index()
    {
        // Obtiene el token de autenticación de la sesión
        $token = session('token');

        // Verifica si el token está presente en la sesión
        if ($token) {
            // Realiza la solicitud HTTP con el token de autenticación
            $response = Http::withToken($token)->get('https://prub.colegiohessen.edu.pe/api/product');

            // Verifica si la solicitud fue exitosa
            if ($response->successful()) {
                $productos = $response->json();
                return view('product.reportProd', compact('productos'));
            } else {
                // Maneja el error si la solicitud no fue exitosa
                return response()->json(['error' => 'Error al obtener los datos de la API'], $response->status());
            }
        } else {
            // Maneja el caso donde no hay token de autenticación en la sesión
            return response()->json(['error' => 'No se encontró token de autenticación en la sesión'], 401);
        }
    }
    public function totalProductos()
    {
    // Obtiene el token de autenticación de la sesión
    $token = session('token');
    // Verifica si el token está presente en la sesión
    if ($token) {
        // Realiza la solicitud HTTP con el token de autenticación
        $response = Http::withToken($token)->get('https://prub.colegiohessen.edu.pe/api/product');
        // Verifica si la solicitud fue exitosa
        if ($response->successful()) {
            $productos = $response->json();
            // Calcula la cantidad total de productos
            $totalProductos = count($productos);
            // Devuelve la vista totalProductos.blade.php y pasa la variable $totalProductos
            return $totalProductos;
        } else {
            // Maneja el error si la solicitud no fue exitosa
            return response()->json(['error' => 'Error al obtener los datos de la API'], $response->status());
        }
    } else {
        // Maneja el caso donde no hay token de autenticación en la sesión
        return response()->json(['error' => 'No se encontró token de autenticación en la sesión'], 401);
    }
    }
    public function totalProductosActivos()
{
    // Obtiene el token de autenticación de la sesión
    $token = session('token');

    // Verifica si el token está presente en la sesión
    if ($token) {
        // Realiza la solicitud HTTP con el token de autenticación
        $response = Http::withToken($token)->get('https://prub.colegiohessen.edu.pe/api/product');

        // Verifica si la solicitud fue exitosa
        if ($response->successful()) {
            $productos = $response->json();

            // Filtra los productos con estado activo
            $productosActivos = array_filter($productos, function ($producto) {
                return $producto['estado'] === 'activo';
            });

            // Calcula la cantidad total de productos con estado activo
            $totalProductosActivos = count($productosActivos);

            return $totalProductosActivos;
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ProductoController extends Controller
{
    public function obtenerProductos()
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
    
                // Calcula la cantidad total de productos
                $totalProductos = count($productos);
                // Calcula la cantidad total de productos con estado activo
                $totalProductosActivos = count($productosActivos);
    
                return [
                    'productos' => $productos,
                    'totalProductos' => $totalProductos,
                    'totalProductosActivos' => $totalProductosActivos
                ];
            } else {
                // Maneja el error si la solicitud no fue exitosa
                return response()->json(['error' => 'Error al obtener los datos de la API'], $response->status());
            }
        } else {
            // Maneja el caso donde no hay token de autenticación en la sesión
            return response()->json(['error' => 'No se encontró token de autenticación en la sesión'], 401);
        }
    }
    
    public function index()
    {
        $data = $this->obtenerProductos();
        $productos = $data['productos'];
        return view('product.reportProd', compact('productos'));
    }
    
    public function totalProductos()
    {
        $data = $this->obtenerProductos();
        $totalProductos = $data['totalProductos'];
        return $totalProductos;
    }
    
    public function totalProductosActivos()
    {
        $data = $this->obtenerProductos();
        $totalProductosActivos = $data['totalProductosActivos'];
        return $totalProductosActivos;
    }

    public function store(Request $request)
    {
        // Obtiene el token de autenticación de la sesión
        $token = session('token');

        // Verifica si el token está presente en la sesión
        if ($token) {
        // Realiza la solicitud HTTP con el token de autenticación
            $response = Http::withToken($token)->post('https://prub.colegiohessen.edu.pe/api/product', [
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'stock' => $request->stock,
                'imagen' => $request->imagen,
                'estado' => $request->estado,
                'categoria_id' => $request->categoria_id,
            ]);

            // Verifica si la solicitud fue exitosa
            if ($response->successful()) {
                return redirect()->back()->with('success', 'producto creado satisfactoriamente');
            } else {
                // Maneja el error si la solicitud no fue exitosa
                return redirect()->back()->with('error', 'Error al crear producto');
            }
        } else {
            // Maneja el caso donde no hay token de autenticación en la sesión
            return response()->json(['error' => 'No se encontró token de autenticación en la sesión'], 401);
        }
    }
    
}


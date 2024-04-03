<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VentaController extends Controller
{
    public function obtenerDetallesProducto($id)
{
    $token = session('token');

    if ($token) {
        // Realiza la solicitud HTTP con el token de autenticación para obtener los detalles del producto a editar
        $response = Http::withToken($token)->get('https://prub.colegiohessen.edu.pe/api/product/' . $id);

        // Verifica si la solicitud fue exitosa
        if ($response->successful()) {
            $producto = $response->json();
            return response()->json($producto);
        } else {
            // Maneja el error si la solicitud no fue exitosa
            return response()->json(['error' => 'Error al obtener los detalles del producto'], $response->status());
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
    $idUsuario = session('id');

    // Verifica si el token está presente en la sesión
    if ($token) {
        $estado = "pendiente";
    // Realiza la solicitud HTTP con el token de autenticación
        $response = Http::withToken($token)->post('https://prub.colegiohessen.edu.pe/api/venta', [
            'id_usuario' => $idUsuario,
            'id_producto' => $request->producto_id,
            'cantidad' => $request->cantidad,
            'precio_unitario' => $request->precio,
            'total_venta' => $request->total_pagar,
            'estado' => $estado,
        ]);

        // Verifica si la solicitud fue exitosa
        if ($response->successful()) {
            return redirect()->back()->with('success', 'venta creado satisfactoriamente');
        } else {
            // Maneja el error si la solicitud no fue exitosa
            return redirect()->back()->with('error', 'Error al crear una');
        }
    } else {
        // Maneja el caso donde no hay token de autenticación en la sesión
        return response()->json(['error' => 'No se encontró token de autenticación en la sesión'], 401);
    }
}

}

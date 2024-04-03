<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VentaController extends Controller
{
    public function index()
    {
        // Obtiene el token de autenticación de la sesión
        $token = session('token');
    
        // Verifica si el token está presente en la sesión
        if ($token) {
            // Realiza la solicitud HTTP con el token de autenticación
            $response = Http::withToken($token)->get('https://prub.colegiohessen.edu.pe/api/venta');
    
            // Verifica si la solicitud fue exitosa
            if ($response->successful()) {
                $ventas = $response->json();
    
                // Filtra los usuarios para mostrar solo aquellos con estado pendiente
                $ventasPendientes = array_filter($ventas, function($venta) {
                    return $venta['estado'] === 'pendiente';
                });
    
                // Retorna la vista 'usuarios.index' y pasa los datos de los usuarios pendientes como variable
                return view('venta.ventapendiente', ['ventas' => $ventasPendientes]);
            } else {
                // Maneja el error si la solicitud no fue exitosa
                return response()->json(['error' => 'Error al obtener los datos de la API'], $response->status());
            }
        } else {
            // Maneja el caso donde no hay token de autenticación en la sesión
            return response()->json(['error' => 'No se encontró token de autenticación en la sesión'], 401);
        }
    }

    public function finalizado()
    {
        // Obtiene el token de autenticación de la sesión
        $token = session('token');
    
        // Verifica si el token está presente en la sesión
        if ($token) {
            // Realiza la solicitud HTTP con el token de autenticación
            $response = Http::withToken($token)->get('https://prub.colegiohessen.edu.pe/api/venta');
    
            // Verifica si la solicitud fue exitosa
            if ($response->successful()) {
                $ventas = $response->json();
    
                // Filtra los usuarios para mostrar solo aquellos con estado pendiente
                $ventasRealizadas = array_filter($ventas, function($venta) {
                    return $venta['estado'] === 'realizado';
                });
    
                // Retorna la vista 'usuarios.index' y pasa los datos de los usuarios pendientes como variable
                return view('venta.ventapendiente', ['ventas' => $ventasRealizadas]);
            } else {
                // Maneja el error si la solicitud no fue exitosa
                return response()->json(['error' => 'Error al obtener los datos de la API'], $response->status());
            }
        } else {
            // Maneja el caso donde no hay token de autenticación en la sesión
            return response()->json(['error' => 'No se encontró token de autenticación en la sesión'], 401);
        }
    }
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

public function finalizarVenta($id)
{
     // Obtiene el token de autenticación de la sesión
    $token = session('token');

    if ($token) {
        $estado = "realizado";
        // Realiza la solicitud HTTP con el token de autenticación
        $response = Http::withToken($token)->put('https://prub.colegiohessen.edu.pe/api/venta/'.$id, [
            'estado' => $estado
        ]);
        if ($response->successful()) {
            return redirect()->back()->with('success', 'venta finaliado satisfactoriamente');
        } else {
            // Maneja el error si la solicitud no fue exitosa
            return redirect()->back()->with('error', 'Error al finalziar la venta');
        }
    } else {
        // Maneja el caso donde no hay token de autenticación en la sesión
        return redirect()->route('ventas.index')->with('error', 'No se encontró token de autenticación en la sesión');
    }
}

}

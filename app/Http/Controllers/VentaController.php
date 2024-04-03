<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VentaController extends Controller
{
    public function realizarCompra(Request $request)
    {
        // Realizar la llamada a la API para obtener la información del producto
        $response = Http::get('');

        // Verificar si la solicitud fue exitosa
        if ($response->successful()) {
            // Decodificar la respuesta JSON
            $producto = $response->json();

            // Generar el mensaje para SweetAlert
            $mensaje = "CÓDIGO DEL PRODUCTO: {$producto['codigo']}\n";
            $mensaje .= "NOMBRE DEL PRODUCTO: {$producto['nombre']}\n";
            $mensaje .= "CATEGORÍA DEL PRODUCTO: {$producto['categoria']}\n";
            $mensaje .= "PRECIO UNITARIO: {$producto['precio']}\n";
            $mensaje .= "TOTAL A PAGAR: {$producto['precio']}\n"; // Ajusta esta parte según tu lógica

            // Mostrar el mensaje con SweetAlert
            return response()->json([
                'success' => true,
                'message' => $mensaje,
            ]);
        } else {
            // Si hay un error en la solicitud a la API, mostrar un mensaje de error
            return response()->json([
                'success' => false,
                'message' => 'Error al realizar la compra. Inténtalo de nuevo más tarde.',
            ]);
        }
    }
}

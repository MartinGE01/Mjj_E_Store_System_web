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
            // Obtener el archivo de imagen de la solicitud
            $imagen = $request->file('imagen');
    
            // Verificar si se cargó correctamente la imagen
            if ($imagen) {
                // Realiza la solicitud HTTP con el token de autenticación
                $response = Http::withToken($token)->attach(
                    'imagen', 
                    fopen($imagen->getRealPath(), 'r'), 
                    $imagen->getClientOriginalName()
                )->post('https://prub.colegiohessen.edu.pe/api/product', [
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'precio' => $request->precio,
                    'stock' => $request->stock,
                    'estado' => $request->estado,
                    'categoria_id' => $request->categoria_id,
                ]);
                
                // Verifica si la solicitud fue exitosa
                if ($response->successful()) {
                    // Manejar la respuesta exitosa
                    return redirect()->back()->with('success', 'Producto creado satisfactoriamente');
                } else {
                    // Manejar la respuesta de error
                    return redirect()->back()->with('error', 'Error al crear producto: ' . $response->getBody());
                }
            } else {
                // Si no se cargó ninguna imagen, retorna un error
                return redirect()->back()->with('error', 'Debe seleccionar una imagen');
            }
        } else {
            // Maneja el caso donde no hay token de autenticación en la sesión
            return response()->json(['error' => 'No se encontró token de autenticación en la sesión'], 401);
        }
    }
    public function eliminarProducto($id)
    {
        $token = session('token');
    
        if ($token) {
            $response = Http::withToken($token)->delete('https://prub.colegiohessen.edu.pe/api/product/'.$id);
    
            if ($response->successful()) {
                return response()->json(['success' => true, 'message' => 'Producto eliminado correctamente']);
            } else {
                return response()->json(['success' => false, 'message' => 'Error al eliminar el producto'], $response->status());
            }
        } else {
            return response()->json(['error' => 'No se encontró token de autenticación en la sesión'], 401);
        }
    }



    public function edit($id)
    {
        $token = session('token');
    
        if ($token) {
            // Realiza la solicitud HTTP con el token de autenticación para obtener los detalles del producto a editar
            $response = Http::withToken($token)->get('https://prub.colegiohessen.edu.pe/api/product/' . $id);
    
            // Verifica si la solicitud fue exitosa
            if ($response->successful()) {
                $producto = $response->json();
               return view('product.updateProduct',['producto'=>$producto ['data']]);

            } else {
                // Maneja el error si la solicitud no fue exitosa
                return redirect()->back()->with('error', 'Error al obtener detalles del producto');
            }
        } else {
            // Maneja el caso donde no hay token de autenticación en la sesión
            return response()->json(['error' => 'No se encontró token de autenticación en la sesión'], 401);
        }
    }

    public function update(Request $request, $id)
    {
        // Verifica si el campo _method existe y su valor es PUT
        if ($request->has('_method') && $request->input('_method') === 'PUT') {
            // Obtiene el token de autenticación de la sesión
            $token = session('token');
    
            // Verifica si el token está presente en la sesión
            if ($token) {
                // Obtener el archivo de imagen de la solicitud
                $imagen = $request->file('imagen');
    
                // Realiza la solicitud HTTP con el token de autenticación
                $response = Http::withToken($token);
    
                // Verifica si se adjuntó una nueva imagen en la solicitud
                if ($imagen) {
                    // Adjunta la nueva imagen a la solicitud
                    $response->attach(
                        'imagen', 
                        fopen($imagen->getRealPath(), 'r'), 
                        $imagen->getClientOriginalName()
                    );
                }
    
                // Agrega el campo _method con el valor PUT como encabezado
                $response = $response->withHeaders(['X-HTTP-Method-Override' => 'PUT']);
    
                // Envía la solicitud HTTP para actualizar el producto
                $response = $response->post('https://prub.colegiohessen.edu.pe/api/product/'. $id, [
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'precio' => $request->precio,
                    'stock' => $request->stock,
                    'estado' => $request->estado,
                    'categoria_id' => $request->categoria_id,
                ]);
    
                // Verifica si la solicitud fue exitosa
                if ($response->successful()) {
                    return redirect()->back()->with('success', 'Producto actualizado satisfactoriamente');
                } else {
                    // Maneja el error si la solicitud no fue exitosa
                    return redirect()->back()->with('error', 'Error al actualizar producto: ' . $response->getBody());
                }
            } else {
                // Maneja el caso donde no hay token de autenticación en la sesión
                return response()->json(['error' => 'No se encontró token de autenticación en la sesión'], 401);
            }
        } else {
            // Maneja el caso donde el método no es PUT
            return redirect()->back()->with('error', 'El método de solicitud no es PUT');
        }
    }
    
}



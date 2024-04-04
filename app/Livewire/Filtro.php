<?php

namespace App\Livewire;

use Livewire\Component;

class Filtro extends Component
{
    public $productosActivos;
    public $productosOriginales;
    public $categoriaSeleccionada;

    public function mount($productos)
    {
        $this->productosActivos = $productos;
        $this->productosOriginales = $productos;
    }

    public function filtrar($categoria)
    {
        if ($this->categoriaSeleccionada == $categoria) {
            $this->categoriaSeleccionada = null;
            $this->productosActivos = $this->productosOriginales;
        } else {
            $this->categoriaSeleccionada = $categoria;
            $this->productosActivos = array_filter($this->productosOriginales, function ($producto) use ($categoria) {
                return $producto['categoria'] == $categoria;
            });
        }
    }

    public function todos(){
        $this->categoriaSeleccionada = null;
        $this->productosActivos = $this->productosOriginales;
    }

    public function render()
    {
        return view('livewire.filtro');
    }
}

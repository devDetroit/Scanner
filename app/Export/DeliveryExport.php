<?php

namespace App\Exports;

use App\Http\Controllers\DeliveryController;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DeliveryExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($dato)
    {
        $this->dato = $dato;
    }

    public function view(): View
    {

        $controlador = new DeliveryController;
        $datos = $controlador->obtenerDatos($this->dato);

        return view('inventarios.reportes.existencias.excel.template', [
            'data' => $datos
        ]);
    }
}

<?php

namespace App\Export;

use App\Http\Controllers\DeliveryController;
use App\Models\Delivery;
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
        /* $datos = $controlador->obtenerDatos($this->dato); */

        $datos = Delivery::all();
        return view('delivery.excel.excel', [
            'data' => $datos
        ]);
    }
}

<?php

namespace App\Export;

use App\Models\Delivery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DeliveryExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function view(): View
    {

        $consulta = Delivery::whereDate('created_at', date('Y-m-d'))->with('user')->get();
        $delivery = collect($consulta);



        $metodos = [
            ['id' => 1, 'metodo' => 'CASH'],
            ['id' => 2, 'metodo' => 'CHECK'],
            ['id' => 3, 'metodo' => 'CREDIT CARD'],
            ['id' => 4, 'metodo' => 'CHARGE ACCOUNT']
        ];
        $totales = $delivery->transform(function ($fechas, $k) use ($metodos) {
            foreach ($metodos as $metodo) {
                $array[$metodo['metodo']] = $fechas->where('payment_method', $metodo['id'])->sum('total');
            }
            return [
                'payform' => $array,
                'total' => $fechas->sum('total'),
            ];
        })->first();

        return view('delivery.excel.excel', [
            'data' => $consulta,
            'totales' => $totales
        ]);
    }
}

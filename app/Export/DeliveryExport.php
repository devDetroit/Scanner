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

    public function view(): View
    {

        return view('delivery.excel.excel', [
            'data' => Delivery::whereDate('created_at', date('Y-m-d'))->get()
        ]);
    }
}

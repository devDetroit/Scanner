<?php

namespace App\Http\Controllers;

use App\Export\DeliveryExport;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\DeliveryMail;
use Illuminate\Support\Facades\Mail;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('delivery.index');
    }

    public function indexReporte()
    {
        return view('delivery.report');
    }

    public function latest()
    {
        return Delivery::orderBy('created_at', 'desc')->get()->take(10);
    }

    public function generar(Request $request)
    {
        $movimiento = $this->obtenerDatos($request);
        return  $movimiento;
    }

    public function excel()
    {
        $currentDate = date('Y-m-d');
        if (!file_exists($this->getStoragePath($currentDate))) {
            Excel::store(new DeliveryExport(), "tmp/reportdelivery$currentDate.csv");
        }
        if (file_exists($this->getStoragePath($currentDate)))
            Mail::to('dortega@detroitaxle.com')->send(new DeliveryMail());
    }

    private function getStoragePath($date)
    {
        return storage_path("app/tmp/reportdelivery$date.csv");
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mail' => 'required|email',
            'shop_name' => 'required|string',
            'shop_address' => 'required|string',
            'driver_assigned' => 'nullable|string',
            'part_number' => 'string',
            'payment_method' => 'required|integer',
            'returned' => 'integer',
            'parts_returned' => 'nullable',
            'total' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $delivery = Delivery::create($request->toArray());
        return $delivery;
    }
}

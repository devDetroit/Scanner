<?php

namespace App\Http\Controllers;

use App\Export\DeliveryExport;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\DeliveryMail;
use Carbon\Carbon;
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



    public function indexDashboard()
    {
        return view('delivery.dashboard');
    }

    public function indexReporte()
    {
        return view('delivery.report');
    }

    public function latest()
    {
        return Delivery::orderBy('created_at', 'desc')->with('user')->get()->take(10);
    }

    public function generateDashboard(Request $request)
    {
        $start = new Carbon($request['start']);
        $enddate = new Carbon($request['end']);
        $delivery = Delivery::whereBetween('created_at', [$start->format('Y-m-d 00:00:00'), $enddate->format('Y-m-d 23:59:59')]);

        if ($request['returned'] != 2) {
            $delivery = $delivery->where('returned', $request['returned']);
        }
        $delivery = $delivery->get();

        if ($delivery->isEmpty()) {
            return 0;
        }

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

        return [
            'totales' => $totales
        ];
    }


    public function generar(Request $request)
    {
        $start = new Carbon($request['startdate']);
        $enddate = new Carbon($request['enddate']);
        $movimiento = Delivery::whereBetween('created_at', [$start->format('Y-m-d 00:00:00'), $enddate->format('Y-m-d 23:59:59')]);
        if ($request->payment) {
            $movimiento = $movimiento->where('payment_method', $request->payment);
        }
        if ($request->returned) {
            $movimiento = $movimiento->where('returned', $request->returned);
        }
        return  $movimiento->with('user')->get();
    }

    public function excel()
    {
        $currentDate = date('Y-m-d');
        if (!file_exists($this->getStoragePath($currentDate))) {
            Excel::store(new DeliveryExport(), "tmp/reportdelivery$currentDate.csv");
        }
        if (file_exists($this->getStoragePath($currentDate)))
            Mail::to('dortega@detroitaxle.com')->cc('cperez@detroitaxle.com')->send(new DeliveryMail());
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
            'shop_name' => 'required|string',
            'shop_address' => 'required|string',
            'driver_assigned' => 'nullable|string',
            'part_number' => 'string',
            'payment_method' => 'required|integer',
            'returned' => 'integer',
            'parts_returned' => 'nullable',
            'total' => 'required',
        ]);

        $request->merge(['user_id' => auth()->user()->id]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $delivery = Delivery::create($request->toArray());
        return $delivery;
    }
}

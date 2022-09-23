<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function generar(Request $request)
    {

        $parametros = $request->busqueda;

        $start = new Carbon($parametros['startdate']);
        $enddate = new Carbon($parametros['enddate']);

        $movimiento = Delivery::whereBetween('created_at', [$start->format('Y-m-d 00:00:00'), $enddate->format('Y-m-d 23:59:59')]);

        if ($parametros['mail'] != '') {
            $movimiento = $movimiento->where('mail', 'LIKE', '%' . $parametros['mail'] . '%');;
        }
        if ($parametros['shop_name'] != '') {
            $movimiento = $movimiento->where('shop_name', 'LIKE', '%' . $parametros['shop_name'] . '%');;
        }
        if ($parametros['shop_address'] != '') {
            $movimiento = $movimiento->where('shop_address', 'LIKE', '%' . $parametros['shop_address'] . '%');;
        }
        if ($parametros['driver_assigned'] != '') {
            $movimiento = $movimiento->where('driver_assigned', 'LIKE', '%' . $parametros['driver_assigned'] . '%');;
        }
        if ($parametros['part_number'] != '') {
            $movimiento = $movimiento->where('part_number', 'LIKE', '%' . $parametros['part_number'] . '%');;
        }
        if ($parametros['payment_method'] != 0) {
            $movimiento = $movimiento->where('payment_method', $parametros['payment_method']);;
        }
        if ($parametros['returned'] != null) {
            $movimiento = $movimiento->where('returned', $parametros['returned']);;
        }
        if ($parametros['parts_returned'] != null) {
            $movimiento = $movimiento->where('parts_returned', $parametros['parts_returned']);;
        }

        if ($parametros['total'] != 0) {
            $movimiento = $movimiento->where('total', $parametros['total']);;
        }
        $movimiento = $movimiento->get();


        return $movimiento;
    }


    public function create()
    {
        //
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
            'driver_assigned' => 'required|string',
            'part_number' => 'required|string',
            'payment_method' => 'required|integer',
            'returned' => 'required|integer',
            'parts_returned' => 'nullable',
            'total' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $delivery = Delivery::create($request->toArray());
        return $delivery;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivery $delivery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        //
    }
}

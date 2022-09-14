<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacilityUser;
use App\Models\MovementLog;
use App\Models\Scanner;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScannerController extends Controller
{
    public function Checar(Request $request)
    {
        $datos = $request;
        $scanner  = Scanner::where('description', $datos->scanner)->where('active', 1)->first();
        if (!$scanner) {
            return 0;
        } else {
            $movimiento = MovementLog::whereHas('scanner', function ($query) use ($scanner) {
                $query->where('description', $scanner->description);
            })->where('end', '=', null)->first();
            if (!$movimiento) {
                $movimiento = new MovementLog;
                $movimiento->scanners_id = $scanner->id;
                $movimiento->start = Carbon::now();
                $movimiento->user = $datos->empleado;
                $movimiento->save();
                $scanner->status = Scanner::ENUSO;
                $scanner->save();
                $tipo  = 1;
            } else {

                if ($movimiento->user !=  $datos->empleado) {
                    return 2;
                }
                $movimiento->end = Carbon::now();
                $movimiento->save();
                $scanner->status = Scanner::DISPONIBLE;
                $scanner->save();
                $tipo  = 2;
            }
            return [
                'scanner' => $scanner,
                'movimiento' => $movimiento,
                'tipo' => $tipo
            ];
        }
    }

    public function listadoIndex()
    {
        return view('escaner.lista');
    }


    public function FacilityPorPermiso()
    {
        $facility = new Facility;
        if (auth()->user()->admin == 0) {
            $facilites = FacilityUser::where('users_id', auth()->user()->id)->get();
            $facility =   $facility->whereIn('id', $facilites->pluck('facilities_id'));
            return $facility->get();
        } else {
            return $facility::get();
        }
    }


    public function ObtenerScanners(Request $request)
    {
        $scanner = new Scanner;

        if (auth()->user()->admin == 0) {
            $facilites = FacilityUser::where('users_id', auth()->user()->id)->get();
            if ($request->facility == '') {
                $scanner =   $scanner->whereIn('facility_id', $facilites->pluck('facilities_id'));
            } else {
                $scanner = $scanner->where('facility_id', $request->facility);
            }
        } else {
            if ($request->facility != '') {
                $scanner = $scanner->where('facility_id', $request->facility);
            }
        }

        $scanner = $scanner->where('active', 1)->with('ultimoregistro', 'facility')->get();

        return $scanner;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacilityUser;
use App\Models\MovementLog;
use App\Models\Scanner;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScannerController extends Controller
{


    public function index()
    {
        return view('escaner.index');
    }

    public function indexLog()
    {
        return view('escaner.log');
    }

    public function obtener()
    {
        return Facility::where('status', 1)->get();
    }

    public function obtenerLog(Request $request)
    {
        $log = new MovementLog;

        if (auth()->user()->admin == 0) {

            $log = $log->whereHas('scanner.facility', function ($query) {
                $facilites = FacilityUser::where('users_id', auth()->user()->id)->get();
                $query->whereIn('facility_id', $facilites->pluck('facilities_id'));
            });
        }

        if ($request->scanner != '') {
            $log = $log->whereHas('scanner', function ($query) use ($request) {
                $query->where('description', 'LIKE', '%' . $request->scanner . '%');
            });
        }

        if ($request->facility != '') {
            $log = $log->whereHas('scanner.facility', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->facility . '%');
            });
        }

        if ($request->start != '') {

            $start = new Carbon($request->start);
            $log = $log->where('start', '>=', $start->format('Y-m-d 00:00:00'))
                /* ->where('end', '<=', $start->format('Y-m-d 23:59:59')) */;
        }

        if ($request->end != '') {

            $end = new Carbon($request->end);
            $log = $log/* ->where('start', '>=', $end->format('Y-m-d 00:00:00')) */
                ->where('end', '<=', $end->format('Y-m-d 23:59:59'));
        }

        if ($request->user != '') {

            $log = $log->where('user', 'LIKE', '%' . $request->user . '%');
        }


        $log = $log->whereHas('scanner', function ($query) use ($request) {
            $query->where('type', 1);
        });


        $log = $log->with('scanner.facility')->paginate(50);

        return [
            'pagination' => [
                'total'        => $log->total(),
                'current_page' => $log->currentPage(),
                'per_page'     => $log->perPage(),
                'last_page'    => $log->lastPage(),
                'from'         => $log->firstItem(),
                'to'           => $log->lastItem(),
            ],
            'log' => $log
        ];
    }

    public function Historial()
    {
        $tmpArr = explode(".", request()->getClientIp());
        array_pop($tmpArr);
        $tmpArr = implode(".", $tmpArr);
        $user = User::where('username', $tmpArr)->first();
        $facilites = FacilityUser::where('users_id', $user->id)->get();
        $scanner = Scanner::whereIn('facility_id', $facilites->pluck('facilities_id'))->get();
        return MovementLog::select('user', 'start', 'end', 'scanners_id')->whereIn('scanners_id', $scanner->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->with('scanner')
            ->get()
            ->take(10);
    }

    public function show(Scanner $scanner)
    {
        $scanner = Scanner::with('facility');
        if (auth()->user()->admin == 0) {
            $facilites = FacilityUser::where('users_id', auth()->user()->id)->get();
            $scanner =  $scanner->whereIn('facility_id', $facilites->pluck('facilities_id'));
        }

        $scanner = $scanner->where('type', 1)->paginate(10);
        return [
            'pagination' => [
                'total'        => $scanner->total(),
                'current_page' => $scanner->currentPage(),
                'per_page'     => $scanner->perPage(),
                'last_page'    => $scanner->lastPage(),
                'from'         => $scanner->firstItem(),
                'to'           => $scanner->lastItem(),
            ],
            'scanner' => $scanner
        ];
    }

    public function store(Request $request)
    {

        $exists = Scanner::where('description', $request['scanner']['description'])->exists();

        if ($exists == 1) {
            return 1;
        }

        $scanner =  Scanner::create(array_merge($request['scanner'], [
            "created_by" => auth()->user()->id
        ]));

        $scanner->type = 1;
        $scanner->save();
        return $scanner;
    }

    public function update(Request $request)
    {

        $escaner = $request['scanner'];

        $exists = Scanner::whereNotIn('id', [$escaner['id']])->where('description', $escaner['description'])->exists();

        if ($exists == 1) {
            return 1;
        }


        $scanner = Scanner::find($escaner['id']);
        $scanner->description = $escaner['description'];
        $scanner->status = $escaner['status'];
        $scanner->facility_id  = $escaner['facility_id'];
        $scanner->active  = $escaner['active'];
        $scanner->updated_by  = auth()->user()->id;
        $scanner->save();
        return $scanner;
    }

    public function delete(Request $request)
    {
        $scanner = $request['scanner'];
        $nuevas = Scanner::where('id', $scanner['id'])->delete();
        $nuevas->deleted_by = auth()->user()->id;
        $nuevas->save();
        return $nuevas;
    }

    public function Checar(Request $request)
    {

        $returnMessage = '';
        $returnValue = 0;

        $scanner  = Scanner::where([
            ['description', $request->scanner],
            ['active', 1],
        ])->first();

        if (!$scanner) {
            return response()->json([
                'returnMessage' => "Escaner ingresado no existe",
                'returnValue' => -1,
            ]);
        }


        $movimiento = MovementLog::where('scanners_id', $scanner->id)->where('end', '=', null)->first();

        if (!$movimiento) {
            $movimiento = MovementLog::create([
                'scanners_id' => $scanner->id,
                'start' => Carbon::now(),
                'user' => $request->empleado
            ]);

            $scanner->status = Scanner::ENUSO;
            $scanner->save();
            $returnMessage = 'Scanner registrado';
            $returnValue = 1;
        } else {
            $movimiento->end = Carbon::now();
            $movimiento->save();
            $scanner->status = Scanner::DISPONIBLE;
            $scanner->save();
            $returnMessage = 'Scanner devuelto';
            $returnValue = 1;
        }

        return response()->json([
            'returnMessage' => $returnMessage,
            'returnValue' => $returnValue,
        ]);
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

        $scanner = $scanner->where('type', $request->type);
        $scanner = $scanner->with('ultimoregistro', 'facility')->orderBy('facility_id')->get();


        return [
            'horaactual' => Carbon::now()->format('Y-m-d H:i:s'),
            'scanner' => $scanner,
            'disponibles' => $scanner->where('status', 0)->count(),
            'enuso' => $scanner->where('status', 1)->count(),
            'inactivos' => $scanner->where('active', 0)->count(),
        ];
    }
}

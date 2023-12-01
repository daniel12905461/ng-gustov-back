<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Anio;
use App\Models\Vacacion;
use App\Models\Dia;
use App\Http\Requests\StoreSolicitudRequest;
use App\Http\Requests\UpdateSolicitudRequest;
use PDF;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $estado = mb_strtoupper($request->input('estado'), "UTF-8");
        // $objs = Solicitud::ofestado($estado)->with('planInternet')->with('zona')->get();
        $objs = Solicitud::with(['vacacion' => function ($q) {
            $q->with('empleado');
        }])->paginate();

        return response()->json(['ok' => true, 'data' => $objs], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $anio = Anio::where('nombre', '2023')->first();

        $vacacion = Vacacion::where('anio_id', $anio->id)->where('empleado_id', $request->input('empleado_id'))->first();
        if ($vacacion) {
            $solicitud = new Solicitud();
            $solicitud->dias_restantes = 0;
            $solicitud->dias_vacaciones = $request->input('dias_solicitados');
            $solicitud->activo = true;
            $solicitud->vacacion_id = $vacacion->id;
            $solicitud->save();

            $dias = $request->input('dias');
            for ($i=0; $i < count($dias); $i++) { 
                $dia = new Dia();
                $dia->fecha = $dias[$i]['fecha'];
                $dia->nombre = $dias[$i]['nombre'];
                $dia->solicitud_id = $solicitud->id;
                $dia->save();
            }

            $vacacion->dias_restantes =  $vacacion->dias_restantes-(int)$request->input('dias_solicitados');
            $vacacion->save();
        }else{

        }

        return response()->json(['ok' => true, 'data' => $solicitud], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Solicitud $solicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Solicitud $solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSolicitudRequest $request, Solicitud $solicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $obj = Solicitud::findOrFail($id);
        $obj->delete();

        return response()->json(['ok' => true, 'data' => $obj], 201);
    }

    public function pdfSolicitudHoja(Request $request)
    {
        $pdf = \App::make('dompdf.wrapper');
        
        $solicitud = Solicitud::with('dias')->with(['vacacion' => function ($q) {
            $q->with('empleado');
        }])->findOrFail($request->input('id'));

        $data = [
            'solicitud' => $solicitud,
        ];
        
        // return response()->json(['ok' => true, 'data' => $data], 201);
        $pdf = PDF::loadView('solicitud', $data);

        return $pdf->stream();
    }
}

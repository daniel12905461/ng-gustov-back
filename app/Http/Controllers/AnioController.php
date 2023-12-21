<?php

namespace App\Http\Controllers;

use App\Models\Anio;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnioRequest;
use App\Http\Requests\UpdateAnioRequest;
use Carbon\Carbon;
use App\Models\Vacacion;

class AnioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        
        // creamos un nuevo año
        $anio = new Anio();
        $anio->nombre = $request->input('nombre');
        $anio->activo = true;
        $anio->save();

        $fechaFin = Carbon::now();
        
        $empleados = Empleado::all();
        foreach ($empleados as $empleado) {

            // creamos un array de años segun la fecha de inicio del empleado
            $fechaInicio = Carbon::parse($empleado->fecha_inicio);
            $anios = [];
            for ($anio = $fechaInicio->year; $anio <= $fechaFin->year; $anio++) {
                $anios[] = $anio;
            }

            // asignamos dias de vacacion segun sus años de antiguedad
            $dias_vacaciones = 0;
            if (count($anios) <= 5) {
                $dias_vacaciones = 15;
            }else{
                if (count($anios) <= 10) {
                    $dias_vacaciones = 20;
                }else{
                    if (count($anios) > 10) {
                        $dias_vacaciones = 30;
                    }else{
                        $dias_vacaciones = 0;
                    }
                }
            }

            // creamos el registro de la tabla de vacacion
            $vacacion = new Vacacion();
            $vacacion->dias_restantes = $dias_vacaciones;
            $vacacion->dias_vacaciones = $dias_vacaciones;
            $vacacion->activo = true;
            $vacacion->empleado_id = $empleado->id;
            $vacacion->anio_id = $anio->id;
            $vacacion->save();
        }

        return response()->json(['ok' => true, 'data' => $anio], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Anio $anio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anio $anio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnioRequest $request, Anio $anio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anio $anio)
    {
        //
    }
}

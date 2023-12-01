<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $objects = Empleado::nombreApellido($request->input('term'))->paginate();
        return response()->json(['ok' => true, 'data' => $objects], 200);
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
        $obj = new Empleado();
        $obj->nombres = $request->input('nombres');
        $obj->apellidos = $request->input('apellidos');
        $obj->fecha_inicio = $request->input('fecha_inicio');
        $obj->save();

        return response()->json(['ok' => true, 'data' => $obj], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $obj = Empleado::findOrFail($id);
        return response()->json(['ok' => true, 'data' => $obj], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        //
        $obj = Empleado::findOrFail($id);
        $obj->nombres = $request->input('nombres');
        $obj->apellidos = $request->input('apellidos');
        $obj->fecha_inicio = $request->input('fecha_inicio');
        $obj->save();

        return response()->json(['ok' => true, 'data' => $obj], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $obj = Empleado::findOrFail($id);
        $obj->delete();

        return response()->json(['ok' => true, 'data' => $obj], 201);
    }

    public function empleadoVacaciones($id)
    {
        $obj = Empleado::with(['vacaciones' => function ($q) {
            $q->where('activo', true);
        }])->findOrFail($id);
        
        // $obj = Empleado::findOrFail($id);

        return response()->json(['ok' => true, 'data' => $obj], 201);
    }
}

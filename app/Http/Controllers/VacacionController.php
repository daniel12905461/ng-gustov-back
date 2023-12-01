<?php

namespace App\Http\Controllers;

use App\Models\Vacacion;
use App\Models\Empleado;
use App\Http\Requests\StoreVacacionRequest;
use App\Http\Requests\UpdateVacacionRequest;

class VacacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $objects = Vacacion::paginate();
        // return response()->json(['ok' => true, 'data' => $objects], 200);
        $objects = Empleado::paginate();
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
    public function store(StoreVacacionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacacion $vacacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacacion $vacacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVacacionRequest $request, Vacacion $vacacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacacion $vacacion)
    {
        //
    }
}

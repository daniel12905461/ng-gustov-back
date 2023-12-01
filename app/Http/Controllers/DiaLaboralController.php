<?php

namespace App\Http\Controllers;

use App\Models\DiaLaboral;
use App\Http\Requests\StoreDiaLaboralRequest;
use App\Http\Requests\UpdateDiaLaboralRequest;

class DiaLaboralController extends Controller
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
    public function store(StoreDiaLaboralRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $obj = DiaLaboral::findOrFail($id);
        return response()->json(['ok' => true, 'data' => $obj], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiaLaboral $diaLaboral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiaLaboralRequest $request, DiaLaboral $diaLaboral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiaLaboral $diaLaboral)
    {
        //
    }
}

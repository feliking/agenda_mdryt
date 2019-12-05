<?php

namespace App\Http\Controllers;

use App\ReferenciaLaboral;
use Illuminate\Http\Request;

class ReferenciaLaboralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ReferenciaLaboral::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return ReferenciaLaboral::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReferenciaLaboral  $referenciaLaboral
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ReferenciaLaboral::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReferenciaLaboral  $referenciaLaboral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = ReferenciaLaboral::findOrFail($id);
        $data->fill($request->all());
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReferenciaLaboral  $referenciaLaboral
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ReferenciaLaboral::findOrFail($id);
        $data->delete();
        return $data;
    }

    /**
     * Busca un elemento especifico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fill($request)
    {
        $request = json_decode($request, true);
        return ReferenciaLaboral::where($request)->get();
    }
}

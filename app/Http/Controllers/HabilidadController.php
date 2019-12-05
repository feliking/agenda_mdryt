<?php

namespace App\Http\Controllers;

use App\Habilidad;
use Illuminate\Http\Request;

class HabilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Habilidad::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Habilidad::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Habilidad  $habilidad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Habilidad::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Habilidad  $habilidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Habilidad::findOrFail($id);
        $data->fill($request->all());
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Habilidad  $habilidad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Habilidad::findOrFail($id);
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
        return Habilidad::where($request)->get();
    }
}

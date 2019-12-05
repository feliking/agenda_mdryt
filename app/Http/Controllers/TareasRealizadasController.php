<?php

namespace App\Http\Controllers;

use App\TareasRealizadas;
use Illuminate\Http\Request;

class TareasRealizadasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TareasRealizadas::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return TareasRealizadas::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TareasRealizadas  $tareasRealizadas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return TareasRealizadas::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TareasRealizadas  $tareasRealizadas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = TareasRealizadas::findOrFail($id);
        $data->fill($request->all());
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TareasRealizadas  $tareasRealizadas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = TareasRealizadas::findOrFail($id);
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
        return TareasRealizadas::where($request)->get();
    }
}

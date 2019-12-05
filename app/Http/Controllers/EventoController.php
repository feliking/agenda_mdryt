<?php

namespace App\Http\Controllers;

use App\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Evento::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Evento::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Evento::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Evento::findOrFail($id);
        $data->fill($request->all());
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Evento::findOrFail($id);
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
        return Evento::where($request)->get();
    }
}

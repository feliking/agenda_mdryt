<?php

namespace App\Http\Controllers;

use App\Delegado;
use Illuminate\Http\Request;

class DelegadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Delegado::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Delegado::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Delegado  $delegado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Delegado::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Delegado  $delegado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Delegado::findOrFail($id);
        $data->fill($request->all());
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Delegado  $delegado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Delegado::findOrFail($id);
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
        return Delegado::where($request)->get();
    }
}

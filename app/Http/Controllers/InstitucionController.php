<?php

namespace App\Http\Controllers;

use App\Institucion;
use Illuminate\Http\Request;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Institucion::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Institucion::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Institucion::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Institucion::findOrFail($id);
        $data->fill($request->all());
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Institucion  $institucion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Institucion::findOrFail($id);
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
        return Institucion::where($request)->get();
    }
}

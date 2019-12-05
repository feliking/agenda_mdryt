<?php

namespace App\Http\Controllers;

use App\ExperienciaLaboral;
use Illuminate\Http\Request;

class ExperienciaLaboralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ExperienciaLaboral::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return ExperienciaLaboral::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExperienciaLaboral  $experienciaLaboral
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ExperienciaLaboral::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExperienciaLaboral  $experienciaLaboral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = ExperienciaLaboral::findOrFail($id);
        $data->fill($request->all());
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExperienciaLaboral  $experienciaLaboral
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ExperienciaLaboral::findOrFail($id);
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
        return ExperienciaLaboral::where($request)->get();
    }
}

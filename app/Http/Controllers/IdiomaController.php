<?php

namespace App\Http\Controllers;

use App\Idioma;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Idioma::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Idioma::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Idioma  $idioma
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Idioma::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Idioma  $idioma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Idioma::findOrFail($id);
        $data->fill($request->all());
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Idioma  $idioma
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Idioma::findOrFail($id);
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
        return Idioma::where($request)->get();
    }
}

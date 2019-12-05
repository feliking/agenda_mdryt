<?php

namespace App\Http\Controllers;

use App\FormacionAcademicaa;
use Illuminate\Http\Request;

class FormacionAcademicaaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FormacionAcademicaa::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return FormacionAcademicaa::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FormacionAcademicaa  $formacionAcademicaa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return FormacionAcademicaa::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FormacionAcademicaa  $formacionAcademicaa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = FormacionAcademicaa::findOrFail($id);
        $data->fill($request->all());
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FormacionAcademicaa  $formacionAcademicaa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = FormacionAcademicaa::findOrFail($id);
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
        return FormacionAcademicaa::where($request)->get();
    }
}

<?php

namespace App\Http\Controllers;

use App\SoftwareManipulable;
use Illuminate\Http\Request;

class SoftwareManipulableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SoftwareManipulable::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return SoftwareManipulable::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SoftwareManipulable  $softwareManipulable
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return SoftwareManipulable::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SoftwareManipulable  $softwareManipulable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = SoftwareManipulable::findOrFail($id);
        $data->fill($request->all());
        $data->save();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SoftwareManipulable  $softwareManipulable
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SoftwareManipulable::findOrFail($id);
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
        return SoftwareManipulable::where($request)->get();
    }
}

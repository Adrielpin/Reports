<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $analistas = \app\User::where('type_id', 2)->get();
        $analista[] = 'Todos';
        foreach ($analistas as $value) {
            $analista[$value->id] = $value->name;
        }

        $clientes = \app\User::where('type_id', 1)->get();
        return view('clientes.index')->with(['clientes'=>$clientes, 'analistas'=>$analista, 'selected'=>null]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) {

        $id = $request->analista;

        if($id == 0){
           return redirect('clientes/');
        }
        
        $find = \App\Relationship::where('analysts', $id)->get(['customers'])->toArray();
        $analista[] = 'Todos';

        $analistas = \app\User::where('type_id', 2)->get();
        foreach ($analistas as $value) {
            $analista[$value->id] = $value->name;
        }

        $clientes = \app\User::find($find);
        return view('clientes.index')->with(['clientes'=>$clientes, 'analistas'=>$analista, 'selected'=>$id]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Session;

class EmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
    	$confis = \Clientes\Models\Config_email::all();
    	return view('emails.index')->with(['confs'=>$confis]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $accounts = \Relatorio\Services\Contas::GetAccounts();

        return view('emails.create')->with(['contas'=>$accounts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $confis = new \Clientes\Models\Config_email;
        $confis->user_id = Auth::user()->id;
        $confis->conta = $request->contas;
        $confis->tipo = $request->tipos;
        $confis->periodo = $request->periodos;
        $confis->grafico = $request->geo;
        $confis->texto = $request->texto;
        $confis->save();

        $request->session()->flash('alert-success', 'Email cadastrado com sucesso.');

        return back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accounts = \Relatorio\Services\Contas::GetAccounts();
        $conf = \Clientes\Models\Config_email::find($id);
        return view('emails.edit')->with(['contas'=>$accounts, 'conf'=>$conf]);
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
        $confis = \Clientes\Models\Config_email::find($id);
        $confis->conta = $request->contas;
        $confis->tipo = $request->tipos;
        $confis->periodo = $request->periodos;
        $confis->grafico = $request->geo;
        $confis->texto = $request->texto;
        $confis->save();

        $request->session()->flash('alert-success', 'Email atualizado com sucesso.');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $confis = \Clientes\Models\Config_email::find($id);
        $confis->delete();

        // redirect
        Session::flash('message', 'E-mail removido!');
        return back();

    }
}

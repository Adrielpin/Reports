<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Session;

//Models
use Models\Config_email;
use Models\User;
use Models\Relationship;

//Adwords
use Relatorio\Contas;



class EmailsController extends Controller
{

    public function index() {	
    	
        $confis = Config_email::all();
    	return view('emails.index')->with(['confs'=>$confis]);    

    }

    public function create() {

        // $accounts = Contas::GetAccounts();
        return view('emails.create')->with(['contas' => $accounts]);

    }

    public function store(Request $request) {

        $confis = new Config_email();
        $confis->user_id = Auth::user()->id;
        $confis->conta = $request->contas;
        $confis->tipo = $request->tipos;
        $confis->periodo = $request->periodos;
        $confis->grafico = $request->geo;
        $confis->texto = $request->texto;
        $confis->save();

        $request->session()->flash('alert-success', 'Email cadastrado com sucesso.');

        return redirect('emails/');

    }


    public function edit($id) {

        $accounts = Contas::GetAccounts();
        $conf = Config_email::find($id);
        return view('emails.edit')->with(['contas'=>$accounts, 'conf'=>$conf]);

    }


    public function update(Request $request, $id) {

        $confis = Config_email::find($id);
        $confis->conta = $request->contas;
        $confis->tipo = $request->tipos;
        $confis->periodo = $request->periodos;
        $confis->grafico = $request->geo;
        $confis->texto = $request->texto;
        $confis->save();

        $request->session()->flash('alert-success', 'Email atualizado com sucesso.');

        return back();
    }

    public function destroy($id) {

        $confis = Config_email::find($id);
        $confis->delete();
        Session::flash('message', 'E-mail removido!');
        return back();

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ClientesController extends Controller
{
    public function index(){
        
        $find = \app\User::all();
        foreach ($find as $row) {
            $analista[$row->id] = $row->name;           
        }

    	$clientes = \App\User::all();
    	return view('clientes.index')->with(['clientes'=>$clientes, 'analista'=>$analista]);
	}

    public function create(){

    	$tipos = \Clientes\Models\Usuario_tipo::all()->except(4);
    	foreach ($tipos as $tipo) {
			$type[$tipo->id] = $tipo->tipo;    		
    	}

    	$find = \app\User::all();
    	foreach ($find as $row) {
			$analista[$row->id] = $row->name;    		
    	}

    	return view('clientes.create')->with(['tipos'=>$type, 'analista'=>$analista]);
    }
}

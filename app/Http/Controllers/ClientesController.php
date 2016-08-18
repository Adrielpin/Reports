<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ClientesController extends Controller
{
    public function index(){
    	$clientes = \App\User::all();
    	return view('clientes.index')->with(['clientes'=>$clientes]);
	}

    public function create(){
    	return view('clientes.create');
    }
}

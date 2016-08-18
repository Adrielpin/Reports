<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PerfilController extends Controller {

    public function show($id) {
        
        $user = \App\User::find($id);
        return view('Perfil.index')->with(['user'=>$user]);

    }

    public function edit($id) {

        return view('Perfil.edit');

    }

    public function update(Request $request, $id) {

        return $id;

    }

}

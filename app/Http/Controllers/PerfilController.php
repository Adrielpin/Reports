<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Models\User;
use Models\Config_email;

use Relatorio\Contas;

class PerfilController extends Controller {

    public function show($id) {

        $user = User::find($id);
        $accounts = Contas::GetIds();

        $confis = Config_email::whereIn('conta', $accounts)->get();
        return view('Perfil.index')->with(['user'=>$user, 'confis'=>$confis]);

    }

    public function edit($id) {

        return view('Perfil.edit');

    }

    public function update(Request $request, $id) {

        return $id;

    }
    
    public function senha() {
        //
    }


}

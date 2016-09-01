<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Hash;
use Session;


class UsuariosController extends Controller {

    public function index () {   
        $rows = \app\User::all();
        return view('usuarios.index')->with(['rows'=>$rows]);
    }

    public function create() {

        $tipos = \Clientes\Models\Usuario_tipo::all()->except(4);
        
        foreach ($tipos as $tipo) {

            $type[$tipo->id] = $tipo->tipo;

        }

        return view('usuarios.create')->with(['tipos'=>$type]);

    }

    public function store (Request $request) {

        $u = new \app\User;
        $u->name = $request->name;
        $u->email = $request->email;
        $u->costumer_id = $request->conta;
        $u->type_id = $request->tipos;
        $u->password = Hash::make($request->newPassword);
        $u->save();

        $request->session()->flash('alert-success', 'Usuário cadastrado com sucesso.');

        return redirect('usuarios/');

    }

    public function edit ($id) {

       $row = \app\User::find($id);
       return view('usuarios.edit')->with(['row'=>$row]);
    }

    public function update (Request $request, $id) {

        $u = \app\User::find($id);
        $u->name = $request->name;
        $u->email = $request->email;
        $u->costumer_id = $request->conta;
        $u->save();

        $request->session()->flash('alert-success', 'Usuário atualizado com sucesso.');

        return redirect('usuarios/');

    }

    public function destroy ($id) {

        $u = \app\User::find($id);
        $u->delete();

        Session::flash('message', 'Usuario removido!');
        return redirect('usuarios/');

    }

}

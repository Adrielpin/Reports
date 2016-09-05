<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Models\User;
use Models\Usuario_tipo;

use Hash;
use Session;


class UsuariosController extends Controller {

    public function index () {   
        $rows = User::all();
        return view('usuarios.index')->with(['rows'=>$rows]);
    }

    public function create() {

        $tipos = Usuario_tipo::all()->except(4);
        
        foreach ($tipos as $tipo) {

            $type[$tipo->id] = $tipo->tipo;

        }

        return view('usuarios.create')->with(['tipos'=>$type]);

    }

    public function store (Request $request) {

        $u = new User();
        $u->name = $request->name;
        $u->email = $request->email;
        $u->costumer_id = $request->conta;
        $u->type_id = $request->tipos;
        $u->password = Hash::make($request->senha);
        $u->save();

        $request->session()->flash('alert-success', 'Usuário cadastrado com sucesso.');

        return redirect('usuarios/');

    }

    public function edit ($id) {

       $row = User::find($id);
       return view('usuarios.edit')->with(['row'=>$row]);
    }

    public function update (Request $request, $id) {

        $u = User::find($id);
        $u->name = $request->name;
        $u->email = $request->email;
        $u->costumer_id = $request->conta;
        $u->save();

        $request->session()->flash('alert-success', 'Usuário atualizado com sucesso.');

        return redirect('usuarios/');

    }

    public function destroy ($id) {

        $u = User::find($id);
        $u->delete();

        Session::flash('message', 'Usuario removido!');
        return redirect('usuarios/');

    }

}

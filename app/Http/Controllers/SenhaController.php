<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\ClasseSenha;

class SenhaController extends Controller
{   
    public function showRecover(){
        return view('recuperar-senha');
    }
    public function executeRecover(Request $request){

        $email = $request->input('email');
        $recuperar = new ClasseSenha();

        $recuperar->enviarEmail($email);
    }
    public function showNew(){
        return view ('nova-senha');
    }
    public function executeNew(Request $request){
        $token = $request->input('token');
        $nova_senha = $request->input('senha');
        $cadastrar = new ClasseSenha();
        $cadastrar->cadastrarNovaSenha($token, $nova_senha);
    }
}

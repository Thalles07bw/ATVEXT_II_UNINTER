<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\ClasseSenhaCandidato;

class SenhaCandidatoController extends Controller
{   
    public function showRecover(){
        return view('recuperar-senha-candidato');
    }
    public function executeRecover(Request $request){

        $email = $request->input('email');
        $recuperar = new ClasseSenhaCandidato();

        $recuperar->enviarEmail($email);
    }
    public function showNew(){
        return view ('nova-senha-candidato');
    }
    public function executeNew(Request $request){
        $token = $request->input('token');
        $nova_senha = $request->input('senha');
        $cadastrar = new ClasseSenhaCandidato();
        $cadastrar->cadastrarNovaSenha($token, $nova_senha);
    }
}

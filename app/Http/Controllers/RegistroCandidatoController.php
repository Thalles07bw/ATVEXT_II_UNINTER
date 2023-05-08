<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Classes\ClasseRegistroCandidato;
use App\Classes\ClasseLoginCandidato;

class RegistroCandidatoController extends Controller
{
    public function show(){    
        return view('registro-candidato');
    }
    public function execute(Request $request){
        $import_registro = new ClasseRegistroCandidato();
        $login_cadastrado = new ClasseLoginCandidato();

        $nome_cliente = $request->input('nome-cliente');
        $email_cliente = $request->input('email-cliente');
        $cpf = $request->input('cpf');

        
        if($login_cadastrado->buscaUsuario($email_cliente) == NULL){

            $import_registro->cadastroInicialCandidato($nome_cliente,$email_cliente, $cpf);
            
        }else{
            $mensagem = "O e-mail já foi cadastrado";
            echo json_encode(["flag" => false, "mensagem" => $mensagem]);
        }

        


    }
}

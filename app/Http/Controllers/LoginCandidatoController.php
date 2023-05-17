<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\ClasseLoginCandidato;

class LoginCandidatoController extends Controller
{   public function show(){
        return view('login-candidato');
    }
    public function execute(Request $request){  
        
        $usuario = new ClasseLoginCandidato();
        $email = $request->input('email');
        $senha = $request->input('senha');

        $dados = $usuario->buscaUsuario($email);
        
        if ($dados != NULL && $dados->usuario_candidato_ativo == 0  && $dados->senha_usuario_candidato == md5($senha)){
            return view('login-candidato',
            [   
                'message' => 'Usuário desativado, procure nossos canais de contato
                 para mais informações.'
            ]); 
        }
        else if ($dados != NULL && $dados->usuario_candidato_validado == 0 ){
            return view('login-candidato',
            [   
                'message' => 'Usuário não validado, 
                 use o link enviado para o seu e-mail para cadastrar sua senha.'
            ]); 
        }
        else if (($dados == NULL || $dados->senha_usuario_candidato != md5($senha))){
            return view('login-candidato',
            [   
                'message' => 'Usuário e/ou senha incorretos.'
            ]);
        }           
        
        //Preenchedo o array de sessão no momento do login
        $_SESSION['id_usuario_candidato'] = $dados->id_usuario_candidato;  
        $_SESSION['nome_usuario_candidato'] = $dados->nome_usuario_candidato;
        $_SESSION['permissao_candidato'] = $dados->id_perfil_usuario;
        $_SESSION['email_usuario_candidato'] = $dados->email_usuario_candidato;
        $_SESSION['cpf_usuario_candidato'] = $dados->cpf_usuario_candidato;

        header ("Location: /portal-do-candidato");
        exit;
    }
}

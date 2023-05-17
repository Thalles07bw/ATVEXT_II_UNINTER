<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\ClasseLogin;

class LoginController extends Controller
{   public function show(){
        return view('login');
    }
    public function execute(Request $request){  
        
        $usuario = new Classelogin();
        $email = $request->input('email');
        $senha = $request->input('senha');

        $dados = $usuario->buscaUsuario($email);
    
        if ($dados != NULL && $dados->usuario_ativo == 0  && $dados->senha_usuario == md5($senha)){
            return view('login',
            [   
                'message' => 'Usuário desativado, procure nossos canais de contato
                 para mais informações.'
            ]); 
        }
        else if ($dados!= NULL && $dados->usuario_validado == 0 ){
            return view('login',
            [   
                'message' => 'Usuário não validado, 
                 use o link enviado para o seu e-mail para cadstrar sua senha.'
            ]); 
        }
        else if (($dados == NULL || $dados->senha_usuario != md5($senha))){
            return view('login',
            [   
                'message' => 'Usuário e/ou senha incorretos.'
            ]);
        }           
        //Dados de instrutor
        $instrutor_usuario = $usuario->buscaIdInstrutor($dados->id_usuario);
        if($instrutor_usuario){
            $_SESSION['id_instrutor'] = $instrutor_usuario->id_instrutor;
        }else{
            $_SESSION['id_instrutor'] = 0;
        }
        //Preenchedo o array de sessão no momento do login
        
        $_SESSION['id_usuario'] = $dados->id_usuario;
        $_SESSION['nome_usuario'] = $dados->nome_usuario;
        $_SESSION['empresa_usuario'] = $dados->id_empresa_contratante;
        $_SESSION['empresa_gerente'] = $dados->id_empresa_contratante;
        $_SESSION['permissao'] = $dados->id_perfil_usuario;

        //determinando tipo da empresa
        $empresa = $usuario->buscaEmpresa($dados->id_empresa_contratante);
        $_SESSION['tipo_empresa'] = $empresa->id_tipo_cliente;
        
        if($dados->id_perfil_usuario == 1){
            header ("Location: /principal");
            exit;
        }else{
            header ("Location: /percentual-treinamento");
            exit;
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Classes\ClasseAutenticacao;
use App\Classes\ClasseLocais;
use App\Classes\ClasseLogin;
use App\Classes\ClasseUsuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function show(){
        
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseLocais = new ClasseLocais();
        $ClasseUsuario = new ClasseUsuario();

        $paises = $ClasseLocais->buscaPaises();
        $niveis_acesso = $ClasseUsuario->buscaNiveisAcesso();
        $tabela = $ClasseUsuario->preencheTabelaUsuarios($_SESSION['empresa_usuario']);

        return view('usuarios', [
            'nome' => $_SESSION['nome_usuario'],
            'nome_pagina' => 'Usuários',
            'tabela' => $tabela,
            'paises' => $paises,
            'perfis' => $niveis_acesso 
        ]);
        
    }
    public function execute(Request $request){

        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseLogin = new ClasseLogin();
        $ClasseUsuario = new ClasseUsuario();

        $nome = $request->input('nome');
        $email = $request->input('email');
        $telefone = $request->input('telefone');
        $niveis_acesso = $request->input('nivel-acesso');
        $empresa = $_SESSION['empresa_usuario'];

       

        $dadosUsuario = array('nome' => $nome,
        'email' => $email,
        'telefone' => $telefone,
        'nivel_acesso' => $niveis_acesso,
        'empresa' => $empresa);

        if($ClasseLogin->buscaUsuario($email) == NULL){
            $ClasseUsuario->cadastraNovoUsuario($dadosUsuario);
        }else{
            $mensagem = "O e-mail já foi cadastrado";
            echo json_encode(["flag" => false, "mensagem" => $mensagem]);
        }
    }

    public function view($id){

        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseUsuario = new ClasseUsuario();

        $resposta = $ClasseUsuario->buscaDadosUsuario($id);

        echo json_encode($resposta);
    }

    public function edit(Request $request){

        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseUsuario = new ClasseUsuario();

        $nome = $request->input('nome');
        $email = $request->input('email');
        $telefone = $request->input('telefone');
        $niveis_acesso = $request->input('nivel-acesso');
        $id = $request->input('id-editar');


        $dadosUsuario = array($nome, $email, $telefone, $niveis_acesso, $id);
 
        $resposta = $ClasseUsuario->atualizaDadosUsuario($dadosUsuario);

        if($resposta == true){
            $mensagem = "Dados do usuário atualizados com sucesso !!!";
            $arrResposta = array('flag' => $resposta, 'mensagem' => $mensagem);
            echo json_encode($arrResposta);
        }else{
            $mensagem = "Dados do usuário não alterados";
            $arrResposta = array('flag' => $resposta, 'mensagem' => $mensagem);
            echo json_encode($arrResposta);
        }
    }
    public function enable($id){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseUsuario = new ClasseUsuario();

        $resposta = $ClasseUsuario->reativaUsuario($id);

        echo json_encode('Usuário reativado com sucesso.');
       
    }
    public function disable($id){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseUsuario = new ClasseUsuario();

        $resposta = $ClasseUsuario->desativaUsuario($id);

        if($resposta == true){
            echo json_encode('Usuário desativado com sucesso.');
        }else{
            echo json_encode('Não é possível desativar este usuário, pois ele é o único administrador');
        }
    }

    public function showDisabled(){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseUsuario = new ClasseUsuario();

        $tabela = $ClasseUsuario->preencheTabelaUsuariosDesativados($_SESSION['empresa_usuario']);

        return view('usuarios-inativos', [
            'nome' => $_SESSION['nome_usuario'],
            'nome_pagina' => 'Usuários Inativos',
            'tabela' => $tabela
        ]);
    }
}

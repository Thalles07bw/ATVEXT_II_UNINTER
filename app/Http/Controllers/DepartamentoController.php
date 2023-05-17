<?php

namespace App\Http\Controllers;

use App\Classes\ClasseDepartamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function show(){
    if(isset($_SESSION['id_usuario'])){
        $ClasseDepartamento = new ClasseDepartamento();    
        $arrayTabela = $ClasseDepartamento->preencheTabelaDepartamentos();
        return view('departamento', [
            'nome_pagina' => 'Departamentos',
            'nome' => $_SESSION['nome_usuario'],
            'tabela' => $arrayTabela
            ]);
        }else{
            header("Location: /login");
            exit;
        } 
    }
    public function execute(Request $request){

        $ClasseDepartamento = new ClasseDepartamento();

        $nome = $request->input('nome-depto');
        $descricao = $request->input('desc-depto');
        $orcamento = $request->input('orcamento-depto');
        $email = $request->input('email-depto');
        $ramal = $request->input('ramal-depto');
        $codigo = $request->input('codigo-depto');
        $empresa = $_SESSION['empresa_usuario'];

        $requestDepartamento = array ( $nome, $descricao, $orcamento, $email, $ramal, $codigo, $empresa);

        $resposta = $ClasseDepartamento->inserirTabelaDepartamento($requestDepartamento);

        
        if($resposta == 1){

            $mensagem = 'O registro foi cadastrado com sucesso !!!';
            
        }else{

            $mensagem = 'Falha ao cadastrar o registro !!!';
        }
        
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);

    }
    public function view($id){

        $ClasseDepartamento = new ClasseDepartamento();
        $row = $ClasseDepartamento->verDepartamentos($id);

        echo json_encode($row);

    }

    public function delete($id){

        $ClasseDepartamento = new ClasseDepartamento();
        $resposta = $ClasseDepartamento->excluirDepartamento($id);
        if($resposta == 1){
            $mensagem = 'O registro foi excluido com sucesso !!!';
        }else{
            $mensagem = 'Falha ao excluir o registro !!!';
        }
        
        echo json_encode($mensagem);
    }

    public function edit(Request $request){
        $ClasseDepartamento = new ClasseDepartamento();

        $nome = $request->input('nome-depto');
        $descricao = $request->input('desc-depto');
        $orcamento = $request->input('orcamento-depto');
        $email = $request->input('email-depto');
        $ramal = $request->input('ramal-depto');
        $codigo = $request->input('codigo-depto');
        $id = $request->input('id-editar');

        $requestEditDepartamento = array ($nome, $descricao, $orcamento, $email, $ramal, $codigo, $id);

        $resposta = $ClasseDepartamento->editarTabelaDepartamento($requestEditDepartamento);

        
        if($resposta == 1){

            $mensagem = 'O registro foi cadastrado com sucesso !!!';
            
        }else{

            $mensagem = 'Falha ao cadastrar o registro !!!';
        }
        
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }
}

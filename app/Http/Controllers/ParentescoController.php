<?php

namespace App\Http\Controllers;

use App\Classes\ClasseParentesco;
use Illuminate\Http\Request;

class ParentescoController extends Controller
{
    public function show(){
        if(isset($_SESSION['id_usuario'])){
            $ClasseParentesco = new ClasseParentesco();
            $tabela = $ClasseParentesco->buscaParentescos();
            return view('cadastro-parentesco', [
                'nome' => $_SESSION['nome_usuario'],
                'nome_pagina' => 'Parentescos',
                'tabela' => $tabela
            ]);
        }else{
            header("Location: /teste/login");
            exit;
        }
    }
    public function execute(Request $request){

        $ClasseParentesco = new ClasseParentesco();
        $nome = $request->input('nome-parentesco');

        $resposta = $ClasseParentesco->inserirTabelaParentesco($nome);

        if($resposta == 1){

            $mensagem = 'O registro foi cadastrado com sucesso !!!';
            
        }else{

            $mensagem = 'Falha ao cadastrar o registro !!!';
        }
        
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }
    public function view($id){

        $ClasseBeneficio = new ClasseParentesco();
        $row = $ClasseBeneficio->verParentesco($id);

        echo json_encode($row);
    }
    public function edit(Request $request){

        $ClasseParentesco = new ClasseParentesco();
        $nome = $request->input('nome-parentesco');
        $id = $request->input('id-editar');

        $resposta = $ClasseParentesco->editarTabelaParentesco($nome, $id);

        if($resposta == 1){

            $mensagem = 'O registro foi cadastrado com sucesso !!!';
            
        }else{

            $mensagem = 'Falha ao cadastrar o registro !!!';
        }
        
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }
    public function delete($id){
        $ClasseParentesco= new ClasseParentesco();
        $resposta = $ClasseParentesco->excluirParentesco($id);
        if($resposta == 1){
            $mensagem = 'O registro foi excluido com sucesso !!!';
        }else{
            $mensagem = 'Falha ao excluir o registro !!!';
        }
        
        echo json_encode($mensagem);
    }
}

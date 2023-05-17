<?php

namespace App\Http\Controllers;

use App\Classes\ClasseExameProcedimento;
use Illuminate\Http\Request;

class ExameProcedimentoController extends Controller
{
    public function show(){
        if(isset($_SESSION['id_usuario'])){
            $ClasseExameProcedimento = new ClasseExameProcedimento();
            $tabela = $ClasseExameProcedimento->buscaExameProcedimento();
            return view('cadastro-exame-procedimento', [
                'nome' => $_SESSION['nome_usuario'],
                'nome_pagina' => 'Parentescos',
                'tabela' => $tabela
            ]);
        }else{
            header("Location: /login");
            exit;
        }
    }
    public function execute(Request $request){

        $ClasseExameProcedimento = new ClasseExameProcedimento();
        $nome = $request->input('nome-exame-proc');

        $resposta = $ClasseExameProcedimento->inserirTabelaExameProcedimento($nome);

        if($resposta == 1){

            $mensagem = 'O registro foi cadastrado com sucesso !!!';
            
        }else{

            $mensagem = 'Falha ao cadastrar o registro !!!';
        }
        
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }
    public function view($id){

        $ClasseBeneficio = new ClasseExameProcedimento();
        $row = $ClasseBeneficio->verExameProcedimento($id);

        echo json_encode($row);
    }
    public function edit(Request $request){

        $ClasseExameProcedimento = new ClasseExameProcedimento();
        $nome = $request->input('nome-exame-proc');
        $id = $request->input('id-editar');

        $resposta = $ClasseExameProcedimento->editarTabelaExameProcedimento($nome, $id);

        if($resposta == 1){

            $mensagem = 'O registro foi cadastrado com sucesso !!!';
            
        }else{

            $mensagem = 'Falha ao cadastrar o registro !!!';
        }
        
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }
    public function delete($id){
        $ClasseExameProcedimento= new ClasseExameProcedimento();
        $resposta = $ClasseExameProcedimento->excluirExameProcedimento($id);
        if($resposta == 1){
            $mensagem = 'O registro foi excluido com sucesso !!!';
        }else{
            $mensagem = 'Falha ao excluir o registro !!!';
        }
        
        echo json_encode($mensagem);
    }
}

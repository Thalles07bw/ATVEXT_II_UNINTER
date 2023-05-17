<?php

namespace App\Http\Controllers;

use App\Classes\ClasseColaborador;
use App\Classes\ClasseDemissao;
use Illuminate\Http\Request;

class DemissaoController extends Controller
{
    public function show(){
        if(isset($_SESSION['id_usuario'])){
            $ClasseDemissao = new ClasseDemissao();
            $ClasseColaborador = new ClasseColaborador();
            $motivos = $ClasseDemissao->buscaMotivosDemissao();
            $colaboradores = $ClasseColaborador->buscaColaboradores();
            $tabela = $ClasseColaborador->buscaColaboradoresDemitidos();
            return view('demissao',[
                'nome' => $_SESSION['nome_usuario'],
                'nome_pagina' => 'Demissões',
                'motivos' => $motivos,
                'colaboradores' => $colaboradores,
                'tabela' => $tabela
            ]);
        }else{
            header("Location: /login");
            exit;
        }
    }

    public function execute(Request $request){
        $ClasseDemissao = new ClasseDemissao();

        $motivo = $request->input('motivo-demissao');
        $colaborador = $request->input('colaborador');

        $resposta = $ClasseDemissao->demitirColaborador($motivo, $colaborador);

        if($resposta  == 1){
            $mensagem = "Os dados de demissão foram cadastrados com sucesso";
        }else{
            $mensagem = "Falha ao cadastrar registro";
        }
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }

    public function cancel($id){

        $ClasseDemissao = new ClasseDemissao();
        $resposta = $ClasseDemissao->cancelarDemissao($id);
        if($resposta == 1){
            $mensagem = 'A demissão foi cancelada com sucesso !!!';
        }else{
            $mensagem = 'Falha ao cancelar o registro !!!';
        }
        
        echo json_encode($mensagem);
    }

    public function edit(Request $request){
        $ClasseDemissao = new ClasseDemissao();

        $motivo = $request->input('motivo-demissao');
        $id = $request->input('id-editar');

        $resposta = $ClasseDemissao->editarDemissao([$motivo, $id]);

        if($resposta  == 1){
            $mensagem = "O registro foi editado com sucesso";
        }else{
            $mensagem = "Falha ao editar registro";
        }
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }

    public function showReason(){
        if(isset($_SESSION['id_usuario'])){
            $ClasseDemissao = new ClasseDemissao();
            $tabela = $ClasseDemissao->buscaMotivosDemissao();
            return view('motivo-demissao',[
                'nome' => $_SESSION['nome_usuario'],
                'nome_pagina' => 'Demissões',
                'tabela' => $tabela
            ]);
        }else{
            header("Location: /login");
            exit;
        }
    }

    public function executeReason(Request $request){
        $ClasseDemissao = new ClasseDemissao();

        $motivo = $request->input('nome-motivo-demissao');

        $resposta = $ClasseDemissao->inserirMotivo($motivo);

        if($resposta  == 1){
            $mensagem = "O registro foi cadastrado com sucesso";
        }else{
            $mensagem = "Falha ao cadastrar registro";
        }
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }
    public function deleteReason($id){

        $ClasseDemissao = new ClasseDemissao();
        $resposta = $ClasseDemissao->excluirMotivo($id);
        if($resposta == 1){
            $mensagem = 'O registro foi excluído com sucesso !!!';
        }else{
            $mensagem = 'Falha ao excluir o registro !!!';
        }
        
        echo json_encode($mensagem);
    }

    public function viewReason($id){
        $ClasseDemissao = new ClasseDemissao();
        $resposta = $ClasseDemissao->verMotivo($id);

        echo json_encode($resposta);

    }

    public function editReason(Request $request){
        $ClasseDemissao = new ClasseDemissao();

        $motivo = $request->input('nome-motivo-demissao');
        $id = $request->input('id-editar');

        $resposta = $ClasseDemissao->editarMotivoDemissao([$motivo, $id]);

        if($resposta  == 1){
            $mensagem = "O registro foi cadastrado com sucesso";
        }else{
            $mensagem = "Falha ao cadastrar registro";
        }
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }
}

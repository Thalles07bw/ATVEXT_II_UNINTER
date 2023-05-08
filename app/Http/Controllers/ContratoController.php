<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\ClasseContrato;

class ContratoController extends Controller
{
    public function show(){
        if(isset($_SESSION['id_usuario'])){
            $ClasseContrato = new ClasseContrato();
            $tabela = $ClasseContrato->buscaTiposContrato();

            return view('cadastro-tipo-contrato',[
                'nome' => $_SESSION['nome_usuario'],
                'nome_pagina' => 'Contratos',
                'tabela' => $tabela
            ]);
        }else{
            header("location: /teste/login");
            exit;
        }
    }

    public function execute(Request $request){
        $ClasseContrato = new ClasseContrato();

        $tipo = $request->input('nome-tipo-contrato');

        $resposta = $ClasseContrato->inserirTipoContrato($tipo);

        if($resposta  == 1){
            $mensagem = "O registro foi cadastrado com sucesso";
        }else{
            $mensagem = "Falha ao cadastrar registro";
        }
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }
    public function delete($id){

        $ClasseContrato = new ClasseContrato();

        $resposta = $ClasseContrato->excluirTipoContrato($id);
        if($resposta == 1){
            $mensagem = 'O registro foi excluido com sucesso !!!';
        }else{
            $mensagem = 'Falha ao excluir o registro !!!';
        }
        
        echo json_encode($mensagem);
    }
    public function view($id){
        $ClasseContrato = new ClasseContrato();

        $resposta = $ClasseContrato->verTipoContrato($id);

        echo json_encode($resposta);

    }

    public function edit(Request $request){
        $ClasseContrato = new ClasseContrato();

        $tipo = $request->input('nome-tipo-contrato');
        $id = $request->input('id-editar');

        $resposta = $ClasseContrato->editarTipoContrato([$tipo, $id]);

        if($resposta  == 1){
            $mensagem = "O registro foi cadastrado com sucesso";
        }else{
            $mensagem = "Falha ao cadastrar registro";
        }
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }
}

<?php

namespace App\Http\Controllers;

use App\Classes\ClasseProva;
use Illuminate\Http\Request;

class QuestoesController extends Controller
{
    public function show($id){
        if(isset($_SESSION['id_usuario'])){
            $ClasseProva = new ClasseProva();
            $dados_prova = $ClasseProva->buscaProvaPorId($id);
            $tabela = $ClasseProva->verQuestoesCadastradas($id);
            return view('criar-questoes',[
                'nome' => $_SESSION['nome_usuario'],
                'nome_pagina' => 'Cadastro de questões',
                'nome_prova' => $dados_prova[0]->nome_prova,
                'id_prova' => $id,
                'tabela' => $tabela,
                'tipo_tempo_prova' => $dados_prova[0]->id_tipo_tempo_prova
            ]);
        }else{
            header("Location: /teste/login");
            exit;
        }
    }
    public function execute($id, Request $request){
        $ClasseProva = new ClasseProva();
        $id_prova = $id;
        
        if($request->input('duracao') != 'undefined'){
            $duracao = $request->input('duracao');
        }else{
            $duracao = NULL;
        }

        $enunciado = $request->input('enunciado-questao');
        
        for($i = 1; $i <= 5; $i++){
            if($request->input('alternativa-'.$i) != null){
                $alternativas[] = $request->input('alternativa-'.$i);
                $alternativa_correta[] = $request->input('correta-'.$i);
            }
        }
        $flag = $ClasseProva->cadastraQuestao($id_prova, $duracao, $enunciado, $alternativas, $alternativa_correta);

        if($flag == true){
            $mensagem = "Sua pergunta e as alternativas foram cadastradas com sucesso";
            $resposta = ["flag" => $flag, "mensagem" => $mensagem];
        }
        echo json_encode($resposta);
    }

    public function cancel($id){

        $ClasseProva = new ClasseProva();
        $resposta = $ClasseProva->AnularQuestao($id);
        if($resposta == 1){
            $mensagem = 'A questão foi anulada com sucesso !!!';
        }else{
            $mensagem = 'Falha ao anular questão !!!';
        }
        
        echo json_encode($mensagem);
    }

    public function showAlternatives($id){
        $ClasseProva = new ClasseProva();
        $resposta = $ClasseProva->buscaAlternativasResposta($id);

        echo json_encode($resposta);
    }
}

<?php

namespace App\Http\Controllers;

use App\Classes\ClasseAutenticacao;
use App\Classes\ClasseCurriculo;
use App\Classes\ClasseProcessoSeletivo;
use App\Classes\ClasseProva;
use Illuminate\Http\Request;

class CandidaturaController extends Controller
{
    public function show(){
        $ClasseAutenticacao = new ClasseAutenticacao;
        $ClasseAutenticacao->checaAutenticacaoCandidato();

        $ClasseCurriculo = new ClasseCurriculo();  
        $ClasseProva = new ClasseProva();

        $dados_usuario = $ClasseCurriculo->buscaDadosUsuario($_SESSION['id_usuario_candidato']);
        $avaliacoes = $ClasseProva->contaProvasPendentesCandidato($_SESSION['id_usuario_candidato']);
        $ClasseProcessoSeletivo = new ClasseProcessoSeletivo();
        $tabela = $ClasseProcessoSeletivo->mostraCandidaturasUsuario($_SESSION['id_usuario_candidato']);
        

        return view('candidaturas',[
            'nome_pagina' => 'Minhas Candidaturas',
            'nome' => $dados_usuario->nome_usuario_candidato,
            'dados_candidato' => $dados_usuario,
            'tabela' => $tabela,
            'provas_pendentes' => $avaliacoes
        ]);
    }
    public function cancel($id){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacaoCandidato();
        
        $ClasseProcessoSeletivo = new ClasseProcessoSeletivo();

        $ClasseProcessoSeletivo->excluiCandidatura($id);

        echo json_encode('Você cancelou a sua inscrição para a vaga.');
    }
}

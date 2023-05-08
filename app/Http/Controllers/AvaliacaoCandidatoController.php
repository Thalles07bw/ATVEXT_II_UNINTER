<?php

namespace App\Http\Controllers;

use App\Classes\ClasseAutenticacao;
use App\Classes\ClasseCurriculo;
use App\Classes\ClasseProva;

class AvaliacaoCandidatoController extends Controller
{
    public function show(){
        $Classeautenticacao = new ClasseAutenticacao();
        $Classeautenticacao->checaAutenticacaoCandidato();
        $ClasseCurriculo = new ClasseCurriculo();
        $ClasseProva = new ClasseProva();
        $dados_usuario = $ClasseCurriculo->buscaDadosUsuario($_SESSION['id_usuario_candidato']);
        $provas_candidato = $ClasseProva->buscaProvasCandidato($_SESSION['id_usuario_candidato']);
        $avaliacoes = $ClasseProva->contaProvasPendentesCandidato($_SESSION['id_usuario_candidato']);


        return view('avaliacoes-candidato',[
            'nome_pagina' => 'Minhas Avaliações',
            'id_usuario' => $_SESSION['id_usuario_candidato'] ,
            'nome' => $_SESSION['nome_usuario_candidato'],
            'dados_candidato' => $dados_usuario,
            'tabela' => $provas_candidato,
            'provas_pendentes' => $avaliacoes
        ]);
    }    
}

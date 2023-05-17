<?php

namespace App\Http\Controllers;

use App\Classes\ClasseCurriculo;
use App\Classes\ClasseLocais;
use App\Classes\ClasseProva;

class PortalCandidatoController extends Controller
{
    public function authentication(){
        $ClasseCurriculo = new ClasseCurriculo();
        $ClasseLocais = new ClasseLocais();
        $ClasseProva = new ClasseProva();
        if(isset($_SESSION['id_usuario_candidato'])){
            $curriculoCandidato = $ClasseCurriculo->buscaDadosCurriculo($_SESSION['id_usuario_candidato']);
            
            if(isset($curriculoCandidato)){
                $cidade = $ClasseLocais->buscaCidadePorId($curriculoCandidato->id_cidade);
                $avaliacoes = $ClasseProva->contaProvasPendentesCandidato($_SESSION['id_usuario_candidato']);
                return view('portal-do-candidato',[
                'nome_pagina' => 'Portal do Candidato',
                'id_usuario' => $_SESSION['id_usuario_candidato'] ,
                'nome' => $_SESSION['nome_usuario_candidato'] ,
                'permissao' => $_SESSION['permissao_candidato'],
                'dados_candidato' => $curriculoCandidato,
                'cidade' => $cidade[0]->nome_cidade,
                'provas_pendentes' => $avaliacoes
                ]);
            }else{
                header("Location: /curriculo");
                exit;
            }
        }else{
            header("Location: /login-candidato");
            exit;
        }
       
    }
}

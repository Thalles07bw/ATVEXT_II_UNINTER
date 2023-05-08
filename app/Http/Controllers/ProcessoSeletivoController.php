<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\ClasseAutenticacao;
use App\Classes\ClasseProcessoSeletivo;
use App\Classes\ClasseProva;
use App\Classes\ClasseToken;
use App\Classes\ClasseVagas;
use App\Classes\ClasseTreinamento;

class ProcessoSeletivoController extends Controller
{
    public function view($id){
        $Classeautenticacao = new Classeautenticacao();
        $Classeautenticacao->checaAutenticacao();

        $ClasseVagas = new ClasseVagas();
        $vaga = $ClasseVagas->buscaDadosVaga($id);
        
        $ClasseProcessoSeletivo = new ClasseProcessoSeletivo();
        $candidatos = $ClasseProcessoSeletivo->buscaCandidatos($id);
        $quadros_vaga = $ClasseProcessoSeletivo->buscaQuadrosEtapas($id);


        return view('quadro-processo-seletivo',[
            'nome_pagina' => 'Quadro de Processo Seletivo',
            'id_usuario' => $_SESSION['id_usuario'] ,
            'nome' => $_SESSION['nome_usuario'] ,
            'empresa' => $_SESSION['empresa_usuario'] ,
            'permissao' => $_SESSION['permissao'],
            'dados_vaga' => $vaga,
            'candidatos' => $candidatos,
            'quadros' => $quadros_vaga,
            'id_vaga' => $id
        ]);
    }
    public function execute(Request $request){
        $id_candidato = $request->input('id_candidato');
        $posicao = $request->input('posicao');
        $vaga = $request->input('id-vaga');
        
        $Classeautenticacao = new ClasseAutenticacao();
        $Classeautenticacao->checaAutenticacao();
        $dados_posicao = array($posicao, $id_candidato, $vaga);
        
        $ClasseProcessoSeletivo = new ClasseProcessoSeletivo();
        $ClasseProcessoSeletivo->atualizaPosicao($dados_posicao);

    }

    public function modifyView($id){
        $Classeautenticacao = new Classeautenticacao();
        $Classeautenticacao->checaAutenticacao();

        $ClasseVagas = new ClasseVagas();
        $ClasseProva = new ClasseProva();
        $quadros = $ClasseVagas->buscaQuadrosProcesso($id);
        $provas_empresa = $ClasseProva->buscaProvasEmpresa($_SESSION['empresa_usuario']);
        $prova_selecionada = $ClasseProva->buscaProvaVaga($id);
        return view('modificar-etapas',[
            'nome_pagina' => 'Modificar etapas do Processo Seletivo',
            'id_usuario' => $_SESSION['id_usuario'] ,
            'id_empresa' => $_SESSION['empresa_usuario'],
            'nome' => $_SESSION['nome_usuario'],
            'id_vaga' => $id,
            'quadros' => $quadros,
            'provas' => $provas_empresa,
            'prova_vaga' => $prova_selecionada
        ]);
    }

    public function modifySave(Request $request){
        $Classeautenticacao = new Classeautenticacao();
        $Classeautenticacao->checaAutenticacao();

        $id_vaga = $request->input('vaga');
        $etapa = $request->input('etapa');
        $ordem = $request->input('ordem');

        $arrQuadros = array($id_vaga, $etapa, $ordem);

        $ClasseProcessoSeletivo = new ClasseProcessoSeletivo();

        $resposta = $ClasseProcessoSeletivo->salvaQuadrosEtapas($arrQuadros);

        if($etapa == 3){
            $ClasseProva = new ClasseProva();
            $ClasseToken = new ClasseToken();
            $token = 'P'.$ClasseToken->geraToken();
            $id_prova = $request->input('prova');
            $data_limite = $request->input('data-limite');
       
            $ClasseProva->salvaProvaToken($id_prova, $token, $id_vaga, $data_limite);

        }

        echo json_encode($resposta);

    }

    public function modifyDelete(Request $request){
        $Classeautenticacao = new Classeautenticacao();
        $Classeautenticacao->checaAutenticacao();

        $id_vaga = $request->input('vaga');
        $etapa = $request->input('etapa');

        $arrQuadros = array($id_vaga, $etapa);

        $ClasseProcessoSeletivo = new ClasseProcessoSeletivo();

        if($etapa == 3){
            $ClasseProva = new ClasseProva();
            $resposta = $ClasseProva->deletaProvaToken($id_vaga);

            if($resposta == false){
                $mensagem = "Não foi possível excluir a etapa de prova, pois existem 
                candidatos classificados a esta etapa.";
                echo json_encode(array('flag' => false , 'mensagem' => $mensagem));
                exit;
            }   
        }

        $resposta = $ClasseProcessoSeletivo->excluiQuadrosEtapas($arrQuadros);


        echo json_encode(array('flag' => $resposta));
    }
    public function applicantTest(Request $request){

        $Classeautenticacao = new Classeautenticacao();
        $Classeautenticacao->checaAutenticacao();

        $id_candidato = $request->input('id-candidato');
        $id_vaga = $request->input('id-vaga');
        $arrCandidatoVaga = array($id_candidato, $id_vaga);

        $ClasseProcessoSeletivo = new ClasseProcessoSeletivo();

        $resposta = $ClasseProcessoSeletivo->definirProvaCandidato($arrCandidatoVaga);
        $arrResposta = array('flag' => $resposta, 'mensagem' => 'A avaliação vinculada 
        a esta vaga será aplicada ao candidato, uma notificação foi enviada para ele.');
        echo json_encode($arrResposta);

    }

    public function showTestResult(Request $request){
        $ClasseAutenticacao =  new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();
        
        $ClasseProcessoSeletivo = new ClasseProcessoSeletivo();
        $ClasseVagas = new ClasseVagas();

        if($request->input("vaga") != NULL){
            $id_vaga = $request->input("vaga");
        }else{
   
            $id_vaga = "";
        }

        if($request->input("candidato") != NULL){
            $id_candidato = $request->input("candidato");
        }else{
   
            $id_candidato = "";
        }
        $vagas = $ClasseVagas->preencheTabelaVagas($_SESSION['empresa_usuario']);
        $candidatos = $ClasseProcessoSeletivo->buscaCandidatosEmpresa($_SESSION['empresa_usuario']);
        $resultado_avaliacao = $ClasseProcessoSeletivo->buscaResultadoAvaliacao($id_vaga,$id_candidato);
        return view('resultados-avaliacoes', [
            'nome_pagina' => 'Resultado de Avaliações',
            'nome' => $_SESSION['nome_usuario'],
            'resultado_avaliacao' => $resultado_avaliacao,
            'id_vaga' => $id_vaga,
            'vagas' => $vagas,
            'id_candidato' => $id_candidato,
            'candidatos' => $candidatos           
        ]);
    }
}

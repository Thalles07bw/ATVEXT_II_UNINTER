<?php

namespace App\Http\Controllers;

use App\Classes\ClasseCargos;
use App\Classes\ClasseAutenticacao;
use Illuminate\Http\Request;


class CargoController extends Controller
{

    public function show(){
    $autenticacao = new ClasseAutenticacao();
    $autenticacao->checaAutenticacao();

    $ClasseCargos = new ClasseCargos();
    $cbos = $ClasseCargos->buscaCBOS();
    $senioridades = $ClasseCargos->buscaSenioridades();
    $escolaridades = $ClasseCargos->buscaEscolaridades();
    $tabela = $ClasseCargos->preencheTabelaCargos();
    return view('cadastro-cargos',[
        'nome_pagina' => 'Cargos',
        'nome' => $_SESSION['nome_usuario'],
        'cbos' => $cbos,
        'senioridades' => $senioridades,
        'escolaridades' => $escolaridades,
        'tabela' => $tabela
        ]);    
    }
    public function execute(Request $request){
        $ClasseCargos = new ClasseCargos();

        $nome = $request->input('nome-cargo');
        $cbo = $request->input('cbo');
        $piso_salarial = $request->input('piso-salarial');
        $atividades_cargo = $request->input('atividades-cargo');
        $desc_cargo= $request->input('desc-cargo');
        $senioridade = $request->input('senioridade');
        $escolaridadeMin = $request->input('escolaridade-min');
        $escolaridadeMax = $request->input('escolaridade-max');

        $requestCargos = array($nome, $cbo, $piso_salarial, $atividades_cargo, $desc_cargo, 
        $senioridade, $escolaridadeMin, $escolaridadeMax, $_SESSION['empresa_usuario']);

     
        
        $resposta = $ClasseCargos->inserirTabelaCargos($requestCargos);

        if($resposta == 1){

            $mensagem = 'O registro foi cadastrado com sucesso !!!';
            
        }else{

            $mensagem = 'Falha ao cadastrar o registro !!!';
        }
        
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }

    public function view($id){

        $ClasseCargos= new ClasseCargos();
        $row = $ClasseCargos->verCargos($id);

        echo json_encode($row);

    }
    public function delete($id){

        $ClasseCargos= new ClasseCargos();
        $resposta = $ClasseCargos->excluirCargo($id);
        if($resposta == 1){

            $mensagem = 'O registro foi excluido com sucesso !!!';
            
        }else{

            $mensagem = 'Falha ao excluir o registro !!!';
        }

        echo json_encode($mensagem);

    }

    public function edit(Request $request){
        $ClasseCargos = new ClasseCargos();
        
        $id = $request->input('id-editar');
        $nome = $request->input('nome-cargo');
        $cbo = $request->input('cbo');
        $piso_salarial = $request->input('piso-salarial');
        $atividades_cargo = $request->input('atividades-cargo');
        $desc_cargo= $request->input('desc-cargo');
        $senioridade = $request->input('senioridade');
        $escolaridadeMin = $request->input('escolaridade-min');
        $escolaridadeMax = $request->input('escolaridade-max');


        $requestEditCargos = array($nome, $cbo, $piso_salarial, $atividades_cargo, $desc_cargo, 
        $senioridade,$escolaridadeMin , $escolaridadeMax,$id);
        
        $resposta = $ClasseCargos->editarTabelaCargos($requestEditCargos);

        if($resposta == 1){

            $mensagem = 'O registro foi cadastrado com sucesso !!!';
            
        }else{

            $mensagem = 'Falha ao cadastrar o registro !!!';
        }
        
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }
}
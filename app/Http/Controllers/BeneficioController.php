<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\ClasseBeneficios;

class BeneficioController extends Controller
{   
    
   
    public function show(){ 
        if(isset($_SESSION['id_usuario'])){
            $ClasseBeneficio = new ClasseBeneficios();

            $tipoBeneficio = $ClasseBeneficio->buscaTipoBeneficio();
            $aplicacaoValor = $ClasseBeneficio->buscaTipoAplicacaoValor();
            $arrayPeriodicidade =  $ClasseBeneficio->buscaPeriodicidade();
            $arrayTabela = $ClasseBeneficio->preencheTabelaBeneficios();

            return view('beneficio', [
                'nome_pagina' => 'Benefícios',
                'nome' => $_SESSION['nome_usuario'],
                'tipoBeneficio' => $tipoBeneficio,
                'aplicacaoValor' => $aplicacaoValor,
                'arrayPeriodicidade' => $arrayPeriodicidade,
                'arrayTabela' => $arrayTabela
            ]);
        }else{
           header("Location: /teste/login");
            exit;
        }

    }
    public function execute(Request $request){
        $ClasseBeneficio = new ClasseBeneficios();

        $nome = $request->input('nome-beneficio');
        $tipo = $request->input('tipo-beneficio');
        $valor_beneficio = $request->input('valor-beneficio');
        $aplicacao_valor = $request->input('aplicacao-beneficio');
        $valor_desconto = $request->input('valor-descontado');
        $periodicidade = $request->input('periodicidade');
        $forma_desconto = $request->input('forma-desconto');
        $empresa = $_SESSION['empresa_usuario'];

        $requestBeneficio = array($nome, $tipo,$valor_beneficio, $aplicacao_valor, $valor_desconto, 
        $periodicidade, $forma_desconto, $empresa);
        
        $resposta = $ClasseBeneficio->inserirTabelaBeneficio($requestBeneficio);

        if($resposta == 1){

            $mensagem = 'O registro foi cadastrado com sucesso !!!';
            
        }else{

            $mensagem = 'Falha ao cadastrar o registro !!!';
        }
        
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
            
    }
    public function view($id){

        $ClasseBeneficio = new ClasseBeneficios();
        $row = $ClasseBeneficio->verBeneficios($id);

        echo json_encode($row);

    }

    public function delete($id){

        $ClasseBeneficio = new ClasseBeneficios();
        $resposta = $ClasseBeneficio->excluirBeneficio($id);
        if($resposta == 1){
            $mensagem = 'O registro foi excluido com sucesso !!!';
        }else{
            $mensagem = 'Falha ao excluir o registro !!!';
        }
        
        echo json_encode($mensagem);
    }

    public function edit(Request $request){
        $ClasseBeneficio = new ClasseBeneficios();
        
        $id = $request->input('id-editar');
        $nome = $request->input('nome-beneficio');
        $tipo = $request->input('tipo-beneficio');
        $valor_beneficio = $request->input('valor-beneficio');
        $aplicacao_valor = $request->input('aplicacao-beneficio');
        $valor_desconto = $request->input('valor-descontado');
        $periodicidade = $request->input('periodicidade');
        $forma_desconto = $request->input('forma-desconto');

        $requestEditBeneficio = array($nome, $tipo,$valor_beneficio, $aplicacao_valor, $valor_desconto, 
        $periodicidade, $forma_desconto, $id);
        
        $resposta = $ClasseBeneficio->editarTabelaBeneficio($requestEditBeneficio);

        if($resposta == 1){

            $mensagem = 'O registro foi cadastrado com sucesso !!!';
            
        }else{

            $mensagem = 'Falha ao cadastrar o registro !!!';
        }
        
        $arrayResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

        echo json_encode($arrayResposta);
    }
}

<?php

namespace App\Http\Controllers;

use App\Classes\ClasseAutenticacao;
use App\Classes\ClasseEmpresas;
use App\Classes\ClasseLocais;
use App\Classes\ClasseRegistro;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    public function show(){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();
        $ClasseLocais = new ClasseLocais();
        $ClasseRegistro = new ClasseRegistro();
        $ClasseEmpresas = new ClasseEmpresas();

        $paises = $ClasseLocais->buscaPaises();
        $tamanho_empresa = $ClasseRegistro->buscaTamanhoEmpresa();
        $empresas_gerenciadas = $ClasseEmpresas->buscaEmpresasGerenciadas($_SESSION['empresa_gerente']);

        return view('cadastrar-empresa',[
            'nome' => $_SESSION['nome_usuario'],
            'nome_pagina' => 'Empresas',
            'paises' => $paises,
            'tamanho_empresa' => $tamanho_empresa,
            'empresas_gerenciadas' => $empresas_gerenciadas

        ]);
    }

    public function alter($id){
        $_SESSION['empresa_usuario'] = $id;

        echo json_encode("Redirecionando para a página principal");
    }

    public function execute(Request $request){

       $ClasseAutenticacao = new ClasseAutenticacao();
       $ClasseAutenticacao->checaAutenticacao();
       
       $form = $request->all();
        
       $ClasseLocais = new ClasseLocais();
       $ClasseEmpresas = new ClasseEmpresas();

       $id_cidade = $ClasseLocais->buscaIdCidade($form['cidade']);
       $id_estado = $ClasseLocais->buscaIdEstado($form['estado']);

       $id_cidade = $id_cidade[0]->id_cidade;
       $id_estado = $id_estado[0]->id_estado;

       $empresa_gerente = $_SESSION['empresa_usuario'];
       $id_tipo_empresa = 3;

       $arrEmpresa = array($form['fantasia'], $form['cnpj'] ,$form['razao-social'], 
       $form['telefone'], $form['tamanho'], $form['num-cep'], $form['logradouro'], 
       $form['numero-endereco'], $form['bairro'], $id_cidade, $id_estado, 
       $form['pais'], $id_tipo_empresa, $empresa_gerente);

        
       $resposta = $ClasseEmpresas->cadastrarEmpresaTipo3($arrEmpresa);

       if($resposta == 1){
        $mensagem = "Nova empresa cadastrada e pronta para ser gerenciada";   
        $arrResposta = array("flag" => $resposta, "mensagem" => $mensagem);

        echo json_encode($arrResposta);

       }else{
        $mensagem = "Falha no cadastro da nova empresa";   
        $arrResposta = array("flag" => $resposta, "mensagem" => $mensagem);

        echo json_encode($arrResposta);
       }

    }

    public function edit(Request $request){

        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();
        
        $form = $request->all();

         
        $ClasseLocais = new ClasseLocais();
        $ClasseEmpresas = new ClasseEmpresas();
 
        $id_cidade = $ClasseLocais->buscaIdCidade($form['cidade']);
        $id_estado = $ClasseLocais->buscaIdEstado($form['estado']);
 
        $id_cidade = $id_cidade[0]->id_cidade;
        $id_estado = $id_estado[0]->id_estado;

 
        $arrEmpresa = array($form['fantasia'], $form['cnpj'] ,$form['razao-social'], 
        $form['telefone'], $form['tamanho'], $form['num-cep'], $form['logradouro'], 
        $form['numero-endereco'], $form['bairro'], $id_cidade, $id_estado, 
        $form['pais'], $form['id-editar']);


        $resposta = $ClasseEmpresas->atualizarDadosEmpresa($arrEmpresa);
 
        if($resposta == 1){
         $mensagem = "Dados Atualizados com Sucesso";   
         $arrResposta = array("flag" => $resposta, "mensagem" => $mensagem);
 
         echo json_encode($arrResposta);
 
        }else{
         $mensagem = "Dados não alterados";   
         $arrResposta = array("flag" => $resposta, "mensagem" => $mensagem);
 
         echo json_encode($arrResposta);
        }
 
    }

    public function view($id){
        $ClasseAutenticacao = new ClasseAutenticacao();
        $ClasseAutenticacao->checaAutenticacao();

        $ClasseEmpresas = new ClasseEmpresas();
        $ClasseLocais = new ClasseLocais();

        $resposta = $ClasseEmpresas->buscaEmpresaPorId($id);

        $cidade = $ClasseLocais->buscaCidadePorId($resposta->id_cidade);
        $resposta->id_cidade = $cidade[0]->nome_cidade;

        $estado = $ClasseLocais->buscaEstadoPorId($resposta->id_estado);
        $resposta->id_estado = $estado[0]->nome_estado;

        echo json_encode($resposta);
    }
}

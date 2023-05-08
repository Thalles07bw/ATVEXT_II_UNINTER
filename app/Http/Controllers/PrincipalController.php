<?php

namespace App\Http\Controllers;

use App\Classes\ClasseEmpresas;
use App\Classes\ClassePrincipal;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function auth(){

        if(isset($_SESSION['id_usuario'])){
            $ClasseEmpresa = new ClasseEmpresas();
            $ClassePrincipal = new ClassePrincipal;

            $nome_empresa = $ClasseEmpresa->buscaEmpresaPorId($_SESSION['empresa_usuario']);
            $om_depto = $ClassePrincipal->orcamentoDeptos($_SESSION['empresa_usuario']);
            $om_colab = $ClassePrincipal->orcamentoColab($_SESSION['empresa_usuario']);
            $qtd_colab = $ClassePrincipal->qtdColab($_SESSION['empresa_usuario']);
            $masc = $ClassePrincipal->contaMasculino($_SESSION['empresa_usuario']);
            $fem = $ClassePrincipal->contaFeminino($_SESSION['empresa_usuario']);
            $lgbt = $ClassePrincipal->contaOutrosGeneros($_SESSION['empresa_usuario']);
            $superior = $ClassePrincipal->contaSuperior($_SESSION['empresa_usuario']);
            $medio = $ClassePrincipal->contaMedio($_SESSION['empresa_usuario']);
            $tecnico = $ClassePrincipal->contaTecnico($_SESSION['empresa_usuario']);
            $fundamental = $ClassePrincipal->contaFundamental($_SESSION['empresa_usuario']);
            $junior = $ClassePrincipal->junior($_SESSION['empresa_usuario']);
            $pleno = $ClassePrincipal->pleno($_SESSION['empresa_usuario']);
            $senior = $ClassePrincipal->senior($_SESSION['empresa_usuario']);
            $estagiario = $ClassePrincipal->estagiario($_SESSION['empresa_usuario']);
            $trainee = $ClassePrincipal->trainee($_SESSION['empresa_usuario']);
            $ma = $ClassePrincipal->menoraprediz($_SESSION['empresa_usuario']);
            $pcd = $ClassePrincipal->pcd($_SESSION['empresa_usuario']);
            $npcd = $ClassePrincipal->npcd($_SESSION['empresa_usuario']);
            
            return view('principal',[
                'nome_pagina' => 'Principal',
                'id_usuario' => $_SESSION['id_usuario'] ,
                'nome' => $_SESSION['nome_usuario'] ,
                'empresa' => $_SESSION['empresa_usuario'] ,
                'permissao' => $_SESSION['permissao'],
                'nome_da_empresa' => $nome_empresa->razao_social_empresa_contratante,
                'om_depto' => $om_depto[0]->om_depto,
                'om_colab' => $om_colab[0]->om_colab,
                'qtd_colab' => $qtd_colab[0]->qtd_colab,
                'masc' => $masc[0]->qtd_colab,
                'fem' => $fem[0]->qtd_colab,
                'lgbt' => $lgbt[0]->qtd_colab,
                'superior' => $superior[0]->qtd_colab,
                'medio' => $medio[0]->qtd_colab,
                'tecnico' => $tecnico[0]->qtd_colab,
                'fundamental' => $fundamental[0]->qtd_colab,
                'junior' => $junior[0]->qtd_colab,
                'pleno' => $pleno[0]->qtd_colab,
                'senior' => $senior[0]->qtd_colab,
                'estagiario' => $estagiario[0]->qtd_colab,
                'trainee' => $trainee[0]->qtd_colab,
                'ma' => $ma[0]->qtd_colab,
                'pcd' => $pcd[0]->qtd_colab,
                'npcd' => $npcd[0]->qtd_colab,
            ]);
        }else{
            header("Location: /teste/login");
            exit;
        }
    }
}

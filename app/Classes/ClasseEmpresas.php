<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;

class ClasseEmpresas{
  public function buscaEmpresasGerenciadas($id_empresa_gerente){
    $resposta = DB::select("SELECT * FROM tb_empresa_contratante WHERE id_empresa_contratante = ?
    OR empresa_gerente = ?
    ",[$id_empresa_gerente, $id_empresa_gerente]);

    return $resposta;
  }

  public function buscaEmpresaPorId($id){
    $resposta = DB::table('tb_empresa_contratante')
                ->where('id_empresa_contratante', $id)
                ->first();

    return $resposta;
  }

  public function cadastrarEmpresaTipo3($arrEmpresa){

    $resposta = DB::insert("INSERT INTO tb_empresa_contratante 
    (nome_fantasia, cnpj_empresa_contratante, razao_social_empresa_contratante,
    numero_telefone,id_tamanho_empresa, cep_empresa_contratante, 
    logradouro_empresa_contratante, numero_endereco_empresa_contratante, 
    bairro_empresa_contratante, id_cidade, id_estado,id_pais,id_tipo_cliente,
    empresa_gerente) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)", $arrEmpresa);

    return $resposta;
  }

  public function atualizarDadosEmpresa($arrEmpresa){
    $resposta = DB::update("UPDATE tb_empresa_contratante 
    SET nome_fantasia = ?, cnpj_empresa_contratante = ?, razao_social_empresa_contratante = ?,
    numero_telefone = ?,id_tamanho_empresa = ?, cep_empresa_contratante = ?, 
    logradouro_empresa_contratante = ?, numero_endereco_empresa_contratante = ?, 
    bairro_empresa_contratante = ?, id_cidade = ?, id_estado = ?,id_pais = ? WHERE id_empresa_contratante = ?",
    $arrEmpresa);

    return $resposta;
  }
}
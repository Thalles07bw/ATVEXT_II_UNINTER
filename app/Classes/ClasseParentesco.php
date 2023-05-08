<?php

namespace App\Classes;
use Illuminate\Support\Facades\DB;

class ClasseParentesco{
  public function buscaParentescos(){
    $parentescos = DB::table('tb_parentesco')->get();
    return $parentescos;
  }

  public function inserirTabelaParentesco($nome){
    $resposta = DB::insert("INSERT INTO tb_parentesco (nome_parentesco) VALUES (?)", [$nome]);

    return $resposta;
  }

  public function verParentesco($id){
    $resposta = DB::select("SELECT * FROM tb_parentesco WHERE id_parentesco = ?", [$id]);

    return $resposta;
  }

  public function editarTabelaParentesco($nome, $id){
    $resposta = DB::update("UPDATE tb_parentesco SET nome_parentesco = ? WHERE id_parentesco = ?", [$nome, $id]);

    return $resposta;
  }

  public function excluirParentesco($id){
    $resposta = DB::delete("DELETE FROM tb_parentesco  WHERE id_parentesco = ?", [$id]);

    return $resposta;

  }
}
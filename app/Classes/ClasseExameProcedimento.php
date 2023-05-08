<?php

namespace App\Classes;
use Illuminate\Support\Facades\DB;

class ClasseExameProcedimento{
  public function buscaExameProcedimento(){
    $exameProcedimento = DB::table('tb_tipo_exame_procedimento')->get();
    return $exameProcedimento;
  }

  public function inserirTabelaExameProcedimento($nome){
    $resposta = DB::insert("INSERT INTO tb_tipo_exame_procedimento (nome_tipo_exame_procedimento) VALUES (?)", [$nome]);

    return $resposta;
  }

  public function verExameProcedimento($id){
    $resposta = DB::select("SELECT * FROM tb_tipo_exame_procedimento WHERE id_tipo_exame_procedimento = ?", [$id]);

    return $resposta;
  }

  public function editarTabelaExameProcedimento($nome, $id){
    $resposta = DB::update("UPDATE tb_tipo_exame_procedimento SET nome_tipo_exame_procedimento = ? WHERE id_tipo_exame_procedimento = ?", [$nome, $id]);

    return $resposta;
  }

  public function excluirExameProcedimento($id){
    $resposta = DB::delete("DELETE FROM tb_tipo_exame_procedimento  WHERE id_tipo_exame_procedimento = ?", [$id]);

    return $resposta;

  }
}
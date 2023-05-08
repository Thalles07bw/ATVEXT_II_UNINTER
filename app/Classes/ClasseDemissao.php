<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;

class ClasseDemissao{
  public function buscaMotivosDemissao(){
    $motivos_demissao = DB::table('tb_motivo_demissao')->get();
    return $motivos_demissao;
  }

  public function inserirMotivo($motivo){
    $resposta = DB::insert('INSERT INTO tb_motivo_demissao (motivo_demissao) VALUES (?)', [$motivo]);
    
    return $resposta; 
  }

  public function excluirMotivo($id){
    $resposta = DB::delete('DELETE FROM tb_motivo_demissao WHERE id_motivo_demissao = ?', [$id]);
    
    return $resposta; 
  }
  public function verMotivo($id){
    $resposta = DB::select('SELECT * FROM tb_motivo_demissao WHERE id_motivo_demissao = ?', [$id]);
    
    return $resposta; 
  }

  public function editarMotivoDemissao($arrayMotivo){
    $resposta = DB::update('UPDATE tb_motivo_demissao SET motivo_demissao = ? WHERE id_motivo_demissao = ?', $arrayMotivo);

    return $resposta;
  }

  public function demitirColaborador($motivo, $colaborador){
    $usuario = DB::table('tb_colaborador')
    ->where('id_colaborador', $colaborador)
    ->first('id_usuario');
    $usuario = $usuario->id_usuario;
    $hoje = date('Y-m-d');

    $atualizacao1 = DB::update("UPDATE tb_colaborador SET data_demissao = ? WHERE 
    id_colaborador = ?", [$hoje, $colaborador]);

    
    $atualizacao2 = DB::update('UPDATE tb_usuario SET usuario_ativo = ?, usuario_validado = ? 
    WHERE id_usuario = ?', [0,0,$usuario]);

    if($atualizacao1 == true || $atualizacao2 == true){
      $resposta = DB::insert("INSERT INTO tb_demissao_colaborador 
      (id_colaborador, id_motivo_demissao) VALUES (?,?)", [$colaborador,$motivo]);

    }else{
      $resposta = false;
    }
    return $resposta;

  }

  public function cancelarDemissao($id){
    $usuario = DB::table('tb_colaborador')
    ->where('id_colaborador', $id)
    ->first('id_usuario');
    $usuario = $usuario->id_usuario;

    $atualizacao1 = DB::update("UPDATE tb_colaborador SET data_demissao = NULL WHERE 
    id_colaborador = ?", [$id]);

    
    $atualizacao2 = DB::update('UPDATE tb_usuario SET usuario_ativo = ?, usuario_validado = ? 
    WHERE id_usuario = ?', [1,1,$usuario]);

    if($atualizacao1 == true || $atualizacao2 == true){
      $resposta = DB::delete("DELETE FROM tb_demissao_colaborador 
      WHERE id_colaborador = ? ", [$id]);

    }else{
      $resposta = false;
    }
    return $resposta;
  }

  public function editarDemissao($arrDemissao){
    $resposta = DB::update("UPDATE tb_demissao_colaborador SET id_motivo_demissao = ? 
    WHERE id_colaborador = ?", $arrDemissao);

    return $resposta;
  }
  
}
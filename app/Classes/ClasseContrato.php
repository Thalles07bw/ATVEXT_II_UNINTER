<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;

class ClasseContrato{
  public function buscaTiposContrato(){
    $motivos_demissao = DB::table('tb_tipo_contrato')->get();
    return $motivos_demissao;
  }

  public function inserirTipoContrato($tipo){
    $resposta = DB::insert('INSERT INTO tb_tipo_contrato (nome_tipo_contrato) VALUES (?)', [$tipo]);
    
    return $resposta; 
  }

  public function excluirTipoContrato($id){
    $resposta = DB::delete('DELETE FROM tb_tipo_contrato WHERE id_tipo_contrato = ?', [$id]);
    
    return $resposta; 
  }
  public function verTipoContrato($id){
    $resposta = DB::select('SELECT * FROM tb_tipo_contrato WHERE id_tipo_contrato = ?', [$id]);
    
    return $resposta; 
  }

  public function editarTipoContrato($arrayMotivo){
    $resposta = DB::update('UPDATE tb_tipo_contrato SET nome_tipo_contrato = ? WHERE id_tipo_contrato = ?', $arrayMotivo);

    return $resposta;
  }
  
}
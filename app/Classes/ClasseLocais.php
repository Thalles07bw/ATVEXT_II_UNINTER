<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;

class ClasseLocais{
  public function buscaPaises(){
    $paises = DB::table('tb_pais')->get();
    return $paises;
  }

  public function buscaEstados(){
    $estados = DB::table('tb_estado')->get();
    return $estados;    
  }

  public function buscaCidades(){
    $cidades = DB::table('tb_cidade')->get();
    return $cidades;
  }

  public function buscaCidadePorId($id){
    $cidade = DB::table('tb_cidade')->where('id_cidade', $id)->get('nome_cidade');
    return $cidade;
  }

  public function buscaEstadoPorId($id){
    $cidade = DB::table('tb_estado')->where('id_estado', $id)->get('nome_estado');
    return $cidade;
  }

  public function buscaIdCidade($nome_cidade){
    $cidade = DB::table('tb_cidade')
    ->where('nome_cidade', $nome_cidade)
    ->get('id_cidade');
    return $cidade;
  }

  public function buscaIdEstado($nome_estado){
    $estado = DB::table('tb_estado')
    ->where('nome_estado', $nome_estado)
    ->get('id_estado');
    return $estado;
  }
}

?>
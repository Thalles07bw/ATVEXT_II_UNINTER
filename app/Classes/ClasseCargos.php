<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;

class ClasseCargos{
  public function buscaCBOS(){

    $resposta = DB::table('tb_cbo')->get();
    return $resposta;

  }

  public function buscaSenioridades(){
    $resposta = DB::table('tb_senioridade')->get();
    return $resposta;
  }
  public function buscaEscolaridades(){
    $resposta = DB::table('tb_escolaridade')->where('id_escolaridade', '<>', 1)->get();
    return $resposta;

  }
  public function preencheTabelaCargos(){
   
    $dados_tabela = DB::select('SELECT id_cargo,nome_cargo, piso_salarial_cargo, nome_senioridade,
    DATE(data_criacao) as data FROM
    tb_cargo as c, tb_senioridade as s WHERE c.id_senioridade = s.id_senioridade
    AND id_empresa = ?',[$_SESSION['empresa_usuario']]);
    
    return $dados_tabela;
  
  }

  public function inserirTabelaCargos($arrayRequestCargo){
 
    $resposta = DB::insert('INSERT INTO tb_cargo (nome_cargo, id_cbo, piso_salarial_cargo,
    atividades_cargo, descricao_sumaria_cargo, id_senioridade, id_escolaridade_min, id_escolaridade_max, id_empresa) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', $arrayRequestCargo);

    return $resposta;
  }
  public function verCargos($id){
   
      $dados_cargo = DB::select('SELECT * FROM tb_cargo WHERE id_cargo = ?',[$id]);
  
      return $dados_cargo;
  }
  public function editarTabelaCargos($requestEditCargos){
    
    $resposta = DB::update('UPDATE tb_cargo SET nome_cargo = ?, id_cbo = ?, 
    piso_salarial_cargo = ?, atividades_cargo = ?, descricao_sumaria_cargo = ?, id_senioridade = ?,
    id_escolaridade_min = ?, id_escolaridade_max = ? 
    WHERE id_cargo = ?', $requestEditCargos);

    return $resposta;
  }

  public function excluirCargo($id){
    $resposta = DB::delete("DELETE FROM tb_cargo WHERE id_cargo = ?", [$id]);
    return $resposta;
  }
}
?>
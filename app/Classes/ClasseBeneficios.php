<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;
class ClasseBeneficios{

  public function buscaTipoBeneficio(){
     $tipo_beneficio = DB::table('tb_tipo_beneficio')->get();
     return $tipo_beneficio; 
  }

  public function buscaTipoAplicacaoValor(){
    $tipo_aplicacao_valor = DB::table('tb_tipo_aplicacao_valor')->get();
    return $tipo_aplicacao_valor; 
  }

  public function buscaPeriodicidade(){
    $periodicidade = DB::table('tb_periodicidade')->get();
    return $periodicidade;
  
  }
  public function preencheTabelaBeneficios(){
   
    $dados_tabela = DB::select('SELECT id_beneficio,nome_beneficio, valor_beneficio, valor_descontado, periodicidade,
    DATE(data_criacao) as data FROM
    tb_beneficio as b, tb_periodicidade as p WHERE p.id_periodicidade = b.id_periodicidade and b.id_empresa = ?', [$_SESSION['empresa_usuario']]);
    
    return $dados_tabela;
  
  }
  public function verBeneficios($id){
   
    $dados_beneficio = DB::select('SELECT * FROM tb_beneficio WHERE id_beneficio = ?',[$id]);

    return $dados_beneficio;
  }

  public function excluirBeneficio($id){
    $resposta = DB::delete('DELETE FROM tb_beneficio WHERE id_beneficio = ?',[$id]);

    return $resposta;
  }

  public function inserirTabelaBeneficio($arrayRequestBeneficio){
 
    $resposta = DB::insert('INSERT INTO tb_beneficio (nome_beneficio, id_tipo_beneficio, valor_beneficio,
    beneficio_aplicado_como, valor_descontado, id_periodicidade, beneficio_descontado_como, id_empresa) 
    VALUES (?, ?, ?, ?, ?, ? ,?, ?)', $arrayRequestBeneficio);

    return $resposta;
  }

  public function editarTabelaBeneficio($arrayRequestEditBeneficio){
    
    $resposta = DB::update('UPDATE tb_beneficio SET nome_beneficio = ?, id_tipo_beneficio = ?, 
    valor_beneficio = ?, beneficio_aplicado_como = ?, valor_descontado = ?, id_periodicidade = ?, 
    beneficio_descontado_como = ? WHERE id_beneficio = ?', $arrayRequestEditBeneficio);

    return $resposta;
  }

  public function excluirCargo($id){
    $resposta = DB::delete("DELETE FROM tb_cargo WHERE id_cargo = ?", [$id]);
    return $resposta;
  }

  public function buscaBeneficios($id_empresa){
    $resposta = DB::table('tb_beneficio')
                ->where('id_empresa', $id_empresa)
                ->get();
    
    return $resposta;
  }

  public function buscaBeneficiosColaborador($id){
    $resposta = DB::table('tb_beneficio_colaborador')
                ->where('id_colaborador', $id)
                ->get('id_beneficio');

    return $resposta;
  }

}
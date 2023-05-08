<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;

class ClasseDepartamento{


  public function preencheTabelaDepartamentos(){
   
    $dados_tabela = DB::table('tb_departamento')
    ->where('id_empresa', $_SESSION['empresa_usuario'])
    ->get();
    
    return $dados_tabela;
  
  }

  public function verDepartamentos($id){
   
    $dados_departamento = DB::select('SELECT * FROM tb_departamento WHERE id_departamento = ?',[$id]);

    return $dados_departamento;
  }
  
  public function excluirDepartamento($id){
    $resposta = DB::delete('DELETE FROM tb_departamento WHERE id_departamento = ?',[$id]);

    return $resposta;
  }

  public function inserirTabelaDepartamento($RequestDepartamento){
 
    $resposta = DB::insert('INSERT INTO tb_departamento (nome_departamento, descricao_departamento,
    orcamento_mensal, email_departamento, ramal_departamento, cod_interno, id_empresa) 
    VALUES (?, ?, ?, ?, ?, ?, ?)', $RequestDepartamento);

    return $resposta;
  }

  public function editarTabelaDepartamento($RequestEditDepartamento){
    
    $resposta = DB::update('UPDATE tb_departamento SET nome_departamento = ?, descricao_departamento = ?, 
    orcamento_mensal = ?, email_departamento = ?, ramal_departamento = ?, cod_interno = ?
    WHERE id_departamento = ?', $RequestEditDepartamento);

    return $resposta;
  }


}
<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;
use App\Classes\ClasseLocais;

class ClasseColaborador{
  private function colaboradorExiste($cpf){
    $resposta = DB::table('tb_colaborador')
    ->where("cpf_colaborador", $cpf)
    ->count();
    if($resposta == 0){
      return false;
    }else{
      return true;
    }
    
  }
  public function buscaColaboradores(){
    $resposta = DB::select('SELECT tc.* FROM tb_colaborador AS tc, tb_departamento as td
    WHERE td.id_departamento = tc.id_departamento AND tc.data_demissao IS NULL
    AND td.id_empresa = ?', [$_SESSION['empresa_usuario']]);
    return $resposta;
  }

  public function buscaColaboradoresDemitidos(){
    $resposta = DB::select('SELECT tc.*, tmd.motivo_demissao 
    FROM tb_colaborador AS tc, tb_departamento as td, 
    tb_demissao_colaborador as tdc, tb_motivo_demissao as tmd
    WHERE td.id_departamento = tc.id_departamento AND tc.id_colaborador = tdc.id_colaborador 
    AND tdc.id_motivo_demissao = tmd.id_motivo_demissao
    AND tc.data_demissao IS NOT NULL
    AND td.id_empresa = ?', [$_SESSION['empresa_usuario']]);
    return $resposta;
  }

  public function buscaSaudacoes(){
    $resposta = DB::table('tb_saudacao')->get();
    return $resposta;
  }

  public function cadastraColaborador($arrColaborador){
    $colaborador_existe = $this->colaboradorExiste($arrColaborador[7]);
    if($colaborador_existe){
      $mensagem = "Já existe um colaborador cadastrado com este CPF";
      $arrResposta = array("flag" => false, "mensagem" => $mensagem);
      return $arrResposta;
    }else{
      $ClasseLocais = new ClasseLocais();

      $id_cidade = $ClasseLocais->buscaIdCidade($arrColaborador[20], $arrColaborador[21]);
      $arrColaborador[20]  = $id_cidade[0]->id_cidade;

      $id_estado = $ClasseLocais->buscaIdEstado($arrColaborador[21]);
      $arrColaborador[21] = $id_estado[0]->id_estado;

      DB::insert("INSERT INTO tb_colaborador (nome_colaborador, email_empresarial, dn_colaborador,
      numero_telefone, id_genero, id_saudacao, id_estado_civil, cpf_colaborador, id_escolaridade,
      id_tipo_contrato, possui_deficiencia, tipo_necessidade_especial, id_cargo, id_departamento,
      id_grau_hierarquico, id_usuario, cep_colaborador, logradouro_colaborador, numero_endereco_colaborador,
      bairro_colaborador, id_cidade, id_estado, id_pais)
      VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", $arrColaborador);

      $mensagem = "Os dados principais do colaborador foram cadastrados com sucesso, 
      use a tabela para adicionar novos dados ou editar os já existentes";
      $arrResposta = array("flag" => true, "mensagem" => $mensagem);
      return $arrResposta;
    }
  }

  public function atualizaFoto($id, $nomeArquivo){

    $resposta = DB::update("UPDATE tb_colaborador SET foto_colaborador = ?  WHERE 
    id_colaborador = ?", [$nomeArquivo, $id]);

    return $resposta;
  }

  public function buscaDadosColaborador($id){
    $resposta = DB::table('tb_colaborador')
    ->where('id_colaborador', $id)
    ->first();

    return $resposta;
  }

  public function editarPrincipaisColaborador($arrColaborador){

      $ClasseLocais = new ClasseLocais();

      $id_cidade = $ClasseLocais->buscaIdCidade($arrColaborador[20], $arrColaborador[21]);
      $arrColaborador[20]  = $id_cidade[0]->id_cidade;

      $id_estado = $ClasseLocais->buscaIdEstado($arrColaborador[21]);
      $arrColaborador[21] = $id_estado[0]->id_estado;

      $resposta = DB::update("UPDATE tb_colaborador SET nome_colaborador = ?, email_empresarial = ?, dn_colaborador = ?,
      numero_telefone = ?, id_genero = ?, id_saudacao = ?, id_estado_civil = ?, cpf_colaborador = ?,
      id_escolaridade = ?, id_tipo_contrato = ?, possui_deficiencia = ?, tipo_necessidade_especial = ?,
      id_cargo = ?, id_departamento = ?, id_grau_hierarquico = ?, id_usuario = ?, cep_colaborador = ?, 
      logradouro_colaborador = ?, numero_endereco_colaborador = ?, bairro_colaborador = ?, 
      id_cidade = ?, id_estado = ?, id_pais = ? WHERE id_colaborador = ?", $arrColaborador);
      if($resposta == true){
        $mensagem = "Os dados foram atualizados com sucesso";
        $arrResposta = array("flag" => true, "mensagem" => $mensagem);
      }else{
        $mensagem = "Não houve alteração nos dados";
        $arrResposta = array("flag" => true, "mensagem" => $mensagem);
      }
      return $arrResposta;
    
  }

  public function editarDocumentosColaborador($arrColaborador){

    $resposta = DB::update("UPDATE tb_colaborador SET rg_colaborador = ?, data_expedicao_rg_colaborador = ?,
    orgao_expedidor_rg_colaborador = ?, titulo_eleitor_colaborador = ?, zona_eleitoral_colaborador = ?,
    secao_eleitoral_colaborador = ?, num_ctps_colaborador = ?, serie_ctps_colaborador = ?,
    pis_colaborador = ?,cnh_colaborador = ?, doc_reservista_colaborador = ?
    WHERE id_colaborador = ?", $arrColaborador);
    if($resposta == true){
      $mensagem = "Os dados foram atualizados com sucesso";
      $arrResposta = array("flag" => true, "mensagem" => $mensagem);
    }else{
      $mensagem = "Não houve alteração nos dados";
      $arrResposta = array("flag" => true, "mensagem" => $mensagem);
    }
    return $arrResposta;
  }
  
  public function editarBancoColaborador($arrColaborador){
    $resposta = DB::update("UPDATE tb_colaborador SET banco_colaborador = ?, agencia_conta_colaborador = ?,
    conta_corrente_colaborador = ? WHERE id_colaborador = ?", $arrColaborador);

    if($resposta == true){
      $mensagem = "Os dados foram atualizados com sucesso";
      $arrResposta = array("flag" => true, "mensagem" => $mensagem);
    }else{
      $mensagem = "Não houve alteração nos dados";
      $arrResposta = array("flag" => true, "mensagem" => $mensagem);
    }
    return $arrResposta;
  }

  public function editarOutrosColaborador($arrColaborador){
    $resposta = DB::update("UPDATE tb_colaborador SET salario = ?, cnpj_colaborador = ?,
    nome_mae_colaborador = ?, nome_pai_colaborador = ?, turno_trabalho = ?, data_contrato = ?,
    vencimento_contrato = ?, periodo_experiencia = ?, naturalidade_colaborador = ?, 
    nacionalidade_colaborador = ? WHERE id_colaborador = ?", $arrColaborador);

    if($resposta == true){
      $mensagem = "Os dados foram atualizados com sucesso";
      $arrResposta = array("flag" => true, "mensagem" => $mensagem);
    }else{
      $mensagem = "Não houve alteração nos dados";
      $arrResposta = array("flag" => true, "mensagem" => $mensagem);
    }
    return $arrResposta;
  }

  public function editarBeneficiosColaborador($arrBeneficios, $id_colaborador){
    
    $resposta = true;

    $deletados = DB::delete("DELETE FROM tb_beneficio_colaborador WHERE id_colaborador = ?", [$id_colaborador]);

    if($arrBeneficios != NULL){

      foreach($arrBeneficios as $value){
      
        $resposta = DB::insert("INSERT INTO tb_beneficio_colaborador (id_beneficio, id_colaborador)
        VALUES (?,?)", [$value, $id_colaborador]);
      }
      
    }

    if($resposta == true){

      $mensagem = "Benefícios do colaborador cadastrados com sucesso";
      $arrResposta = array("flag" => $resposta, 
      "dados_excluidos" => $deletados, "mensagem" => $mensagem);

      return $arrResposta;

    }else{

      $mensagem = "Ocorreu um erro na inserção dos benefícios";
      $arrResposta = array("flag" => $resposta, 
      "dados_excluidos" => $deletados, "mensagem" => $mensagem);

      return $arrResposta;

    }

    
    
  }



}
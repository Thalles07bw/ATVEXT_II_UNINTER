<?php
  namespace App\Classes;
  use Illuminate\Support\Facades\DB;
  class ClassePrincipal{

    public function orcamentoDeptos($id_empresa){
      $resposta = DB::select("SELECT sum(td.orcamento_mensal)/count(*) om_depto
      from tb_departamento td WHERE id_empresa = ?", [$id_empresa]);

      return $resposta;
    }

    public function orcamentoColab($id_empresa){
      $resposta = DB::select("SELECT sum(tc.salario)/count(*) om_colab FROM tb_colaborador tc 
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador 
      where td.id_empresa = ? AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2);", [$id_empresa]);

      return $resposta;
    }

    public function qtdColab($id_empresa){
      $resposta = DB::select("SELECT count(*) qtd_colab FROM tb_colaborador tc 
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador 
      where td.id_empresa = ? AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2);", [$id_empresa]);

      return $resposta;
    }

    public function contaFeminino($id_empresa){
      $resposta = DB::select("SELECT count(*) qtd_colab FROM tb_colaborador tc 
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador 
      where td.id_empresa = ? AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2) AND tc.id_genero = 1", [$id_empresa]);

      return $resposta;
    }

    public function contaMasculino($id_empresa){

      $resposta = DB::select("SELECT count(*) qtd_colab FROM tb_colaborador tc 
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador 
      where td.id_empresa = ? AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2) AND tc.id_genero = 2", [$id_empresa]);

      return $resposta;

    }

    public function contaOutrosGeneros($id_empresa){

      $resposta = DB::select("SELECT count(*) qtd_colab FROM tb_colaborador tc 
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador 
      where td.id_empresa = ? AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2) AND tc.id_genero NOT IN (1,2)", [$id_empresa]);

      return $resposta;

    }

    public function contaSuperior($id_empresa){

      $resposta = DB::select("SELECT count(*) qtd_colab FROM tb_colaborador tc
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador 
      where td.id_empresa = 1 AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2) AND tc.id_escolaridade IN (6,7,8,9,10,11)", [$id_empresa]);

      return $resposta;
      
    }

    public function contaMedio($id_empresa){

      $resposta = DB::select("SELECT count(*) qtd_colab FROM tb_colaborador tc
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador 
      where td.id_empresa = ? AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2) AND tc.id_escolaridade IN (4,5)", [$id_empresa]);

      return $resposta;
      
    }

    public function contaTecnico($id_empresa){

      $resposta = DB::select("SELECT count(*) qtd_colab FROM tb_colaborador tc
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador 
      where td.id_empresa = ? AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2) AND tc.id_escolaridade IN (12);", [$id_empresa]);

      return $resposta;
      
    }

    public function contaFundamental($id_empresa){

      $resposta = DB::select("SELECT count(*) qtd_colab FROM tb_colaborador tc
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador 
      where td.id_empresa = ? AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2) AND tc.id_escolaridade IN (2,3)", [$id_empresa]);

      return $resposta;
      
    }

    public function pcd($id_empresa){

      $resposta = DB::select("SELECT count(*) qtd_colab FROM tb_colaborador tc
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador 
      where td.id_empresa = ? AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2) AND tc.possui_deficiencia = 1", [$id_empresa]);

      return $resposta;

    }

    public function npcd($id_empresa){

      $resposta = DB::select("SELECT count(*) qtd_colab FROM tb_colaborador tc
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador 
      where td.id_empresa = ? AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2) AND tc.possui_deficiencia = 0", [$id_empresa]);

      return $resposta;

    }
    
    public function junior($id_empresa){

      $resposta = DB::select("SELECT count(*) qtd_colab FROM tb_colaborador tc
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador
      LEFT JOIN tb_cargo tc2 on tc2.id_cargo = tc.id_cargo
      WHERE td.id_empresa = ? AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2)
      AND tc.id_grau_hierarquico = 1;", [$id_empresa]);

      return $resposta;

    }
    
    public function pleno($id_empresa){

      $resposta = DB::select("SELECT count(*) qtd_colab FROM tb_colaborador tc
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador
      LEFT JOIN tb_cargo tc2 on tc2.id_cargo = tc.id_cargo
      WHERE td.id_empresa = ? AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2)
      AND tc.id_grau_hierarquico = 2;", [$id_empresa]);

      return $resposta;

    }
    
    public function senior($id_empresa){

      $resposta = DB::select("SELECT count(*) qtd_colab FROM tb_colaborador tc
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador
      LEFT JOIN tb_cargo tc2 on tc2.id_cargo = tc.id_cargo
      WHERE td.id_empresa = ? AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2)
      AND tc.id_grau_hierarquico = 3", [$id_empresa]);

      return $resposta;

    }
    
    public function estagiario($id_empresa){

      $resposta = DB::select("SELECT count(*) qtd_colab FROM tb_colaborador tc
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador
      LEFT JOIN tb_cargo tc2 on tc2.id_cargo = tc.id_cargo
      WHERE td.id_empresa = ? AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2)
      AND tc.id_grau_hierarquico = 4", [$id_empresa]);

      return $resposta;

    }
    
    public function trainee($id_empresa){

      $resposta = DB::select("SELECT count(*) qtd_colab FROM tb_colaborador tc
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador
      LEFT JOIN tb_cargo tc2 on tc2.id_cargo = tc.id_cargo
      WHERE td.id_empresa = ? AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2)
      AND tc.id_grau_hierarquico = 5", [$id_empresa]);

      return $resposta;

    }
    
    public function menoraprediz($id_empresa){

      $resposta = DB::select("SELECT count(*) qtd_colab FROM tb_colaborador tc
      LEFT JOIN tb_departamento td ON tc.id_departamento = td.id_departamento
      LEFT JOIN tb_demissao_colaborador tdc ON tdc.id_colaborador = tc.id_colaborador
      LEFT JOIN tb_cargo tc2 on tc2.id_cargo = tc.id_cargo
      WHERE td.id_empresa = ? AND tc.id_colaborador NOT IN (select tdc2.id_colaborador from tb_demissao_colaborador tdc2)
      AND tc.id_grau_hierarquico = 7", [$id_empresa]);

      return $resposta;

    }
    

    

  }
?>
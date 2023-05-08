<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;

class ClasseProcessoSeletivo{
  public function buscaCandidatos($id_vaga){
    $candidatos = DB::select('SELECT ct.id_candidato, uc.id_usuario_candidato ,uc.nome_usuario_candidato, ct.foto_candidato, cr.posicao_candidato FROM tb_vaga as v, 
    tb_candidatura as cr, tb_candidato ct, tb_usuario_candidato uc WHERE
    v.id_vaga = cr.id_vaga AND ct.id_candidato = cr.id_candidato AND
    uc.id_usuario_candidato = ct.id_usuario_candidato AND v.id_vaga = ?', [$id_vaga]);

    return $candidatos;
 
  }

  public function atualizaPosicao($dados_posicao_candidato){
    $resposta = DB::update('UPDATE tb_candidatura SET posicao_candidato = ? 
    WHERE id_candidato = ? AND id_vaga = ?', $dados_posicao_candidato);

    return $resposta;

  }

  public function buscaQuadrosEtapas($id){
    $resposta = DB::select('SELECT tev.*, te.etapa FROM tb_etapa_vaga tev, tb_etapa te
     WHERE  te.id_etapa = tev.id_etapa AND id_vaga = ? ORDER BY ordem', [$id]);

    return $resposta;
  }

  public function salvaQuadrosEtapas($arrQuadros){
    $checkExists = DB::table('tb_etapa_vaga')->where('id_vaga', $arrQuadros[0])
    ->where('id_etapa', $arrQuadros[1])->first();

    if ($checkExists == NULL){
      $resposta = DB::insert("INSERT INTO tb_etapa_vaga (id_vaga, id_etapa, ordem) VALUES (?,?,?)", $arrQuadros);
    }else{
      $resposta = DB::update("UPDATE tb_etapa_vaga SET ordem = ? WHERE id_vaga = ? AND id_etapa = ?",
      [$arrQuadros[2], $arrQuadros[0], $arrQuadros[1]]);
    }

    return $resposta;
  }
  public function excluiQuadrosEtapas($arrQuadros){
    $resposta = 0;
    $checkExists = DB::table('tb_etapa_vaga')->where('id_vaga', $arrQuadros[0])
    ->where('id_etapa', $arrQuadros[1])->first();
    if ($checkExists != NULL){
      $resposta = DB::delete("DELETE FROM tb_etapa_vaga WHERE id_vaga = ? AND id_etapa = ?", $arrQuadros);
    }
    return $resposta;
  }

  public function mostraCandidaturasUsuario($id){
    $id_candidato = DB::table('tb_candidato')->where('id_usuario_candidato', $id)->get('id_candidato')->first();
    $id_candidato = $id_candidato->id_candidato;

    $resposta = DB::select("SELECT tcan.id_candidatura,tvag.titulo_vaga,tec.razao_social_empresa_contratante,DATE_FORMAT(tcan.data_criacao, '%d/%m/%Y %H:%i') as data_criacao FROM tb_candidatura as tcan, tb_vaga as
    tvag, tb_cargo tcrg, tb_empresa_contratante tec 
    WHERE tcan.id_vaga  = tvag.id_vaga AND tvag.id_cargo = tcrg.id_cargo
    AND tec.id_empresa_contratante = tcrg.id_empresa AND tcan.id_candidato = ? ", [$id_candidato]);

    return $resposta;
  }

  public function excluiCandidatura($id){
    $resposta = DB::delete("DELETE FROM tb_candidatura WHERE id_candidatura = ?", [$id]);
  
    return $resposta;
  }

  public function definirProvaCandidato($arrCandidatoVaga){
    $id_prova = DB::table('tb_token_prova')->where('id_vaga', $arrCandidatoVaga[1])->first('id_prova');
    $id_prova = $id_prova->id_prova;

    $checkExists = DB::table('tb_candidato_prova')->where('id_vaga', $arrCandidatoVaga[1])
    ->where('id_candidato', $arrCandidatoVaga[0])->where('id_prova', $id_prova)->first();
    if($checkExists == NULL){
      $resposta = DB::insert("INSERT INTO tb_candidato_prova (id_candidato, id_prova, id_vaga) VALUES (?,?,?)", 
      [$arrCandidatoVaga[0],$id_prova, $arrCandidatoVaga[1]]);
    }else{
      return false;
    }

    return $resposta;

  }

  public function buscaResultadoAvaliacao($id_vaga, $id_candidato){
    $resposta = DB::select("SELECT  tuc.nome_usuario_candidato, tv.titulo_vaga, tp.nome_prova ,tcp.percentual_acerto, tc.foto_candidato from tb_candidato_prova tcp 
    INNER JOIN tb_candidato tc ON tcp.id_candidato = tc.id_candidato
    INNER JOIN tb_usuario_candidato tuc ON tuc.id_usuario_candidato = tc.id_usuario_candidato
    INNER JOIN tb_vaga tv on tv.id_vaga = tcp.id_vaga
    INNER JOIN tb_prova tp on tcp.id_prova = tp.id_prova 
    WHERE tc.id_candidato = ? AND tcp.id_vaga = ?", [$id_candidato, $id_vaga]);

    return $resposta;
  }

  public function buscaCandidatosEmpresa($id_empresa){
    $resposta = DB::select("SELECT DISTINCT tc.id_candidato ,CONCAT(tuc.cpf_usuario_candidato,' - ',tuc.nome_usuario_candidato) as candidato FROM tb_candidato tc
    INNER JOIN tb_usuario_candidato tuc ON tuc.id_usuario_candidato = tc.id_usuario_candidato 
    INNER JOIN tb_candidatura tc2 on tc.id_candidato = tc2.id_candidato
    INNER JOIN tb_vaga tv on tv.id_vaga = tc2.id_vaga 
    INNER JOIN tb_cargo tc3 on tv.id_cargo = tc3.id_cargo 
    WHERE tc3.id_empresa = ?", [$id_empresa]);

    return $resposta;
  }

}
  
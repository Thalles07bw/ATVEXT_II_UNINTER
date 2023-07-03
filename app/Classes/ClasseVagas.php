<?php
namespace App\Classes;

use Exception;
use Illuminate\Support\Facades\DB;

class ClasseVagas{

  public function buscaCargosCadastrados(){
    $resposta = DB::select("SELECT id_cargo, CONCAT(c.nome_cargo,' ', s.nome_senioridade) AS cargo FROM tb_cargo as c, tb_senioridade s 
    WHERE s.id_senioridade =c.id_senioridade");

    return $resposta;
  }

  public function buscaStatusVaga(){
    $resposta = DB::table('tb_status_vaga')->get();
    return $resposta;
  }

  public function buscaVagasAtivas(){
    $resposta = DB::select('SELECT t.id_vaga, t.titulo_vaga, t.descricao_vaga, c.nome_cargo, c.id_empresa, tec.razao_social_empresa_contratante , t.prazo_processo_seletivo, c.piso_salarial_cargo
    FROM tb_vaga t, tb_cargo c, tb_empresa_contratante tec  WHERE t.id_cargo = c.id_cargo AND tec.id_empresa_contratante = c.id_empresa  AND prazo_processo_seletivo >= current_date');

    return $resposta;
  }

  public function inserirTabelaVagas($requestVagas){
   /* $resposta = DB::insert("INSERT INTO tb_vaga (titulo_vaga, id_cargo, qtd_posicao, video_vaga,
     prazo_processo_seletivo, descricao_vaga, id_status_vaga) VALUES (?,?,?,?,?,?,?)", $requestVagas);*/

    $inserted_id = DB::table('tb_vaga')->insertGetId(
      [ 'titulo_vaga' => $requestVagas[0],
        'id_cargo' => $requestVagas[1],
        'qtd_posicao' => $requestVagas[2],
        'video_vaga' => $requestVagas[3],
        'prazo_processo_seletivo' => $requestVagas[4],
        'descricao_vaga' => $requestVagas[5],
        'id_status_vaga' => $requestVagas[6]
    ]);

    $resposta = DB::insert("INSERT INTO tb_etapa_vaga (id_vaga, id_etapa, ordem) VALUES (?,?,?)",
    [$inserted_id, 1, 1]);
    $resposta = DB::insert("INSERT INTO tb_etapa_vaga (id_vaga, id_etapa, ordem) VALUES (?,?,?)",
    [$inserted_id, 6, 6]);

    return $resposta;
    
  }

  public function preencheTabelaVagas($id_empresa){
    $resposta = DB::SELECT('SELECT v.id_vaga, v.titulo_vaga, v.id_status_vaga, s.nome_senioridade ,v.qtd_posicao, v.prazo_processo_seletivo,sv.status_vaga
    FROM tb_vaga as v, tb_status_vaga as sv, tb_cargo c , tb_senioridade s 
    WHERE v.id_status_vaga = sv.id_status_vaga AND c.id_senioridade = s.id_senioridade
    AND v.id_cargo = c.id_cargo AND c.id_empresa = ?', [$id_empresa]);
    
    return $resposta;
  }

  public function verVagas($id){

    $resposta = DB::select('SELECT * FROM tb_vaga WHERE id_vaga = ?',[$id]);

    return $resposta;
  }

  public function editarTabelaVagas($requestEditVagas){
    
    $resposta = DB::update('UPDATE tb_vaga SET titulo_vaga = ?, id_cargo = ?, 
    qtd_posicao = ?, video_vaga = ?, prazo_processo_seletivo = ?, descricao_vaga = ?, id_status_vaga = ? 
    WHERE id_vaga = ?', $requestEditVagas);

    return $resposta;
  }

  public function excluirVaga($id){
    $contaResultado = DB::table('tb_candidatura')->where('id_vaga', $id)->count();
    if($contaResultado != 0){
      
      $resposta = false;
    }else{
      try{
        $resposta = DB::delete('DELETE FROM tb_vaga WHERE id_vaga = ?',[$id]);
      }catch(Exception $e){
        $resposta = false;
      }
    }
    return $resposta;

  }

  public function personalizarMural($requestPersonalizacao){
    $resposta = DB::insert('INSERT INTO tb_personalizacao_mural (cor, logo, linkedin, facebook, 
    twitter, instagram, youtube, cor_icone ,id_empresa) VALUES (?,?,?,?,?,?,?,?,?)', $requestPersonalizacao);

    return $resposta;

  }
  public function buscaPersonalizacaoAtual($id_empresa){
    $dados_personalizacao = DB::select("SELECT * FROM tb_personalizacao_mural WHERE id_empresa = ?", [$id_empresa]);

    return $dados_personalizacao;
  }

  public function editarPersonalizarMural($requestPersonalizacao){
    $resposta = DB::update('UPDATE tb_personalizacao_mural SET cor = ?, logo = ?, linkedin = ?, 
    facebook = ?, twitter = ?, instagram = ?, youtube = ?, cor_icone = ? WHERE id_empresa = ?', $requestPersonalizacao);

    return $resposta;

  }

  public function listaVagasPorEmpresa($id_empresa){

    $resposta = DB::select('SELECT v.id_vaga, v.titulo_vaga, v.descricao_vaga,v.qtd_posicao, v.prazo_processo_seletivo, 
    s.nome_senioridade FROM tb_vaga as v, tb_senioridade as s, tb_cargo as c 
    WHERE s.id_senioridade = c.id_senioridade AND v.id_cargo = c.id_cargo AND id_status_vaga = ?
    AND c.id_empresa = ?',[1 ,$id_empresa]);

    return $resposta;
  }

  public function buscaDadosVaga($id){
    $resposta = DB::table('tb_vaga')->where('id_vaga', $id)->first();
    return $resposta;
  }

  public function candidatura($dados_candidatura){
    $id_candidato = DB::table('tb_candidato')->where('id_usuario_candidato', $dados_candidatura[1])->get('id_candidato');
    $id_candidato = $id_candidato[0]->id_candidato;
    
    $busca_candidatura = DB::table('tb_candidatura')->where('id_vaga',$dados_candidatura[0])->where('id_candidato', $id_candidato)->get()->first();

    if($busca_candidatura == NULL){
      $id_candidato = DB::table('tb_candidato')->where('id_usuario_candidato', $dados_candidatura[1])->get('id_candidato');
      $id_candidato = $id_candidato[0]->id_candidato;
      $resposta = DB::insert("INSERT INTO  tb_candidatura (id_vaga, id_candidato) VALUES (?,?)", [$dados_candidatura[0], $id_candidato]);
      return $resposta;

    }else{
      return false;
    }
    
  }
  public function buscaQuadrosProcesso($id){
    $resposta = DB::table('tb_etapa_vaga')->where('id_vaga', $id)->get();

    return $resposta;
  }

}
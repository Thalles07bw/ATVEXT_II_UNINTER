<?php
namespace App\Classes;

use Exception;
use Illuminate\Support\Facades\DB;


class ClasseProva{

  public function buscaNomeProva($id){
     $nome_prova = DB::select('SELECT nome_prova FROM tb_prova WHERE id_prova = ?', [$id]);
     $nome_prova = $nome_prova[0]->nome_prova;
    
     return $nome_prova; 
  }
  
  public function buscaQuestoesProva($id){
    $questoes = DB::select('SELECT id_pergunta_prova, pergunta_prova, tempo_pergunta_prova FROM
    tb_pergunta_prova WHERE id_prova = ? AND ativo = 1 ORDER BY id_pergunta_prova ASC', [$id]);

    return $questoes;
  }

  public function buscaAlternativasQuestao($id){
    $alternativas = DB::select('SELECT id_resposta_prova, resposta_prova FROM tb_resposta_prova WHERE id_pergunta_prova = ?', [$id]);
    
    return $alternativas;
  }

  public function salvaQuestao( $token_prova, $id_questao, $alternativa, $id){

    $id_candidato = DB::table('tb_candidato')->where('id_usuario_candidato', $id)->get('id_candidato')->first();
    $id_candidato = $id_candidato->id_candidato;

    $reposta = DB::insert('INSERT INTO tb_resultado_questao (token_avaliacao, alternativa_escolhida,
    id_questao, id_candidato) VALUES (?,?,?,?)',[$token_prova, $alternativa, $id_questao, $id_candidato]);
    
    return $reposta;
  }

  public function mostraPercentualAcerto($token_prova, $id_usuario){
    $id_candidato = DB::table('tb_candidato')->where('id_usuario_candidato', $id_usuario)->get('id_candidato')->first();
    $id_candidato = $id_candidato->id_candidato;

    $acertos = DB::select('SELECT count(*) as acertos FROM tb_resultado_questao WHERE  token_avaliacao = ? AND
    id_candidato = ? AND alternativa_escolhida IN (SELECT id_resposta_prova FROM tb_resposta_prova
    WHERE resposta_correta = 1)',[$token_prova, $id_candidato]);

    $total_questões = DB::select('SELECT count(*) as total from tb_resultado_questao WHERE
     token_avaliacao = ? AND id_candidato = ? AND id_questao IN (SELECT id_pergunta_prova FROM tb_pergunta_prova
    WHERE ativo = 1)',[$token_prova, $id_candidato]);

    $percentual = ($acertos[0]->acertos/$total_questões[0]->total)*100;

    return $percentual;
  }

  public function buscaNivelProva(){
    $reposta =  DB::table('tb_nivel_prova')->get();
    return $reposta;
  }

  public function buscaCategoriaProva(){
    $reposta =  DB::table('tb_categoria_prova')->get();
    return $reposta;
  }

  public function buscaTipoTempoProva(){
    $reposta = DB::select("SELECT * FROM tb_tipo_tempo_prova");
    return $reposta;
  }

  public function criaNovaAvaliacao($nome_prova, $nivel, $categoria, $tipo_tempo, $duracao, $id_empresa){
    $reposta = DB::insert("INSERT INTO tb_prova (nome_prova, id_nivel_prova, id_categoria_prova, id_tipo_tempo_prova, tempo_total_prova, id_empresa)
    VALUES (?,?,?,?,?,?)",[$nome_prova, $nivel, $categoria, $tipo_tempo, $duracao, $id_empresa]);
    
    return $reposta;
  }

  public function buscaProvasCadastradas(){
    $reposta = DB::select('SELECT id_prova,nome_prova, nivel_prova, p.data_criacao, t.tipo_tempo_prova
    FROM tb_prova as p, tb_nivel_prova as n, tb_tipo_tempo_prova as t
    WHERE n.id_nivel_prova = p.id_nivel_prova AND p.id_tipo_tempo_prova = t.id_tipo_tempo_prova 
    AND p.ativo = 1;');
    return $reposta;
  }
  public function buscaProvasDesabilitadas(){
    $reposta = DB::select('SELECT id_prova,nome_prova, nivel_prova, p.data_criacao, t.tipo_tempo_prova
    FROM tb_prova as p, tb_nivel_prova as n, tb_tipo_tempo_prova as t
    WHERE n.id_nivel_prova = p.id_nivel_prova AND p.id_tipo_tempo_prova = t.id_tipo_tempo_prova 
    AND p.ativo = 0;');
    return $reposta;
  }

  public function buscaProvaPorId($id){
    $reposta = DB::select('SELECT id_prova,nome_prova, nivel_prova, p.data_criacao, p.id_tipo_tempo_prova FROM tb_prova as p,
    tb_nivel_prova as n WHERE n.id_nivel_prova = p.id_nivel_prova AND id_prova = ?;',[$id]);
    return $reposta;
  }

  public function cadastraQuestao($id_prova, $duracao, $enunciado, $alternativas, $alternativa_correta){
    $error = false;
    if($duracao !== NULL){
     $duracao = str_replace(',','.',$duracao);
    }

    $id_pergunta = DB::table('tb_pergunta_prova')->insertGetId([
      'id_prova' => $id_prova,
      'id_tipo_pergunta_prova' => 1,
      'pergunta_prova' => $enunciado,
      'tempo_pergunta_prova' => $duracao
    ]);

    foreach($alternativas as $chave => $valor){
      $resposta = DB::insert('INSERT INTO tb_resposta_prova (id_pergunta_prova, resposta_prova, resposta_correta) 
      VALUES (?,?,?)',[$id_pergunta, $valor, $alternativa_correta[$chave]]);
      
      if($resposta != 1){
        $error = true;
      } 
    }
    if($error === true){
      return false;
    }else{
      return true;
    }
  }

  public function verQuestoesCadastradas($id){
    $resposta = DB::select('SELECT * FROM tb_pergunta_prova WHERE id_prova = ? AND ativo = 1',[$id]);

    return $resposta;

  }
  public function anularQuestao($id){

    $resposta = DB::update('UPDATE tb_pergunta_prova SET ativo = 0 WHERE id_pergunta_prova = ?', [$id]);
    
    return $resposta;
  }
  public function buscaAlternativasResposta($id){
    $resposta = DB::select('SELECT * FROM tb_resposta_prova WHERE id_pergunta_prova = ?',[$id]);
    return $resposta;
  }

  public function criaCopiaProva($id){
    $prova = DB::select('SELECT * FROM tb_prova WHERE id_prova = ?', [$id]);
    
    $copia = array(
      $prova[0]->nome_prova.' Cópia', 
      $prova[0]->id_nivel_prova,
      $prova[0]->id_categoria_prova,
      $prova[0]->tempo_total_prova,
      $prova[0]->id_tipo_tempo_prova,
      $prova[0]->id_empresa
    );

    $copiaProva = DB::table('tb_prova')->insertGetId(
      ['nome_prova' => $copia[0], 
      'id_nivel_prova' => $copia[1],
      'id_categoria_prova' => $copia[2],
      'tempo_total_prova' => $copia[3], 
      'id_tipo_tempo_prova' => $copia[4],
      'id_empresa' => $copia[5]]
    );

    $questoes = DB::select('SELECT * FROM tb_pergunta_prova WHERE id_prova = ? AND ativo = ?', [$prova[0]->id_prova, 1]);
    if($questoes != NULL){
      foreach ($questoes as  $value){
        $copiaPerguntas = DB::table('tb_pergunta_prova')->insertGetId(
          ['id_prova' => $copiaProva, 
          'id_tipo_pergunta_prova' => $value->id_tipo_pergunta_prova,
          'pergunta_prova' => $value->pergunta_prova,
          'tempo_pergunta_prova' => $value->tempo_pergunta_prova
        ]);

        $alternativaCopia = DB::select('SELECT * FROM tb_resposta_prova WHERE id_pergunta_prova = ?',
        [$value->id_pergunta_prova]);

        foreach ($alternativaCopia as $value2){
          $resposta = DB::insert('INSERT INTO tb_resposta_prova (id_pergunta_prova, resposta_prova, resposta_correta) 
          VALUES (?,?,?)',[$copiaPerguntas, $value2->resposta_prova, $value2->resposta_correta]);
        }
      }
    }else{
      //retorna sucesso ao criar uma cópia mesmo que não exista questões cadastradas 
      $resposta = true;
    }
    return $resposta; 
  }
  public function desativarProva($id){
    $resposta = DB::update('UPDATE tb_prova SET ativo = 0 WHERE id_prova = ?', [$id]);
    return $resposta;
  }

  public function ativarProva($id){
    $resposta = DB::update('UPDATE tb_prova SET ativo = 1 WHERE id_prova = ?', [$id]);
    return $resposta;
  }

  public function buscaDadosProva($id){
    $resposta = DB::select('SELECT nome_prova, id_nivel_prova, id_tipo_tempo_prova, tempo_total_prova FROM tb_prova WHERE id_prova = ?', [$id]);
    return $resposta;
  }

  public function atualizarProva($id, $nome_prova, $id_nivel_prova){
    $resposta = DB::update('UPDATE tb_prova SET nome_prova = ?, id_nivel_prova = ? 
    WHERE id_prova = ?', [$nome_prova, $id_nivel_prova, $id]);

    return $resposta;
  }
  
  public function buscaProvasEmpresa($id_empresa){
    $resposta = DB::table('tb_prova')->where('id_empresa', $id_empresa)->where('ativo', '1')->get();

    return $resposta;
  }
  public function buscaProvaVaga($id_vaga){
    $resposta = DB::table('tb_token_prova')->where('id_vaga', $id_vaga)->first(['id_prova', 'data_limite']);

    return $resposta;
  }

  public function salvaProvaToken($prova, $token, $id_vaga, $data_limite){
    $prova_vaga = DB::table('tb_token_prova')->where('id_vaga', $id_vaga)->first();

    if($prova_vaga == NULL){

      $resposta = DB::insert("INSERT INTO tb_token_prova (id_prova, token, id_vaga, data_limite) VALUES (?,?,?,?)", 
      [$prova, $token, $id_vaga, $data_limite]);
    }else{
      $resposta = DB::update('UPDATE tb_token_prova SET id_prova = ?, token = ?, data_limite = ? WHERE id_vaga = ?',
      [$prova, $token, $data_limite, $id_vaga]);
    }

    return $resposta;
  }

  public function deletaProvaToken($id_vaga){
    try{
      $resposta = DB::delete("DELETE FROM tb_token_prova WHERE id_vaga = ?",[$id_vaga]);
    }catch(Exception $e){
      $resposta = false;
    }
    return $resposta;
  }

  public function buscaProvasCandidato($id_usuario_candidato){
    $id_candidato = DB::table('tb_candidato')->where('id_usuario_candidato', $id_usuario_candidato)
    ->first('id_candidato');
    $id_candidato = $id_candidato->id_candidato;

    $reposta = DB::select('SELECT tp.id_prova, tp.nome_prova, tv.titulo_vaga, tec.razao_social_empresa_contratante, 
      tcp.percentual_acerto, ttp.token, tcp.prova_feita, ttp.data_limite 
      FROM  tb_candidato tcan, tb_vaga tv, tb_prova tp , tb_candidato_prova tcp, tb_cargo tcar,
      tb_empresa_contratante tec,  tb_token_prova ttp
      WHERE tcan.id_candidato = tcp.id_candidato AND tp.id_prova = tcp.id_prova AND
      tcar.id_empresa = tec.id_empresa_contratante AND tcar.id_cargo = tv.id_cargo AND ttp.id_vaga = tcp.id_vaga
      AND tv.id_vaga = tcp.id_vaga AND tcp.id_candidato = ?',[$id_candidato]);
    
    return $reposta;
  }

  public function defineResultadoProva($id_prova, $percentual, $id_usuario_candidato, $token){
    $id_vaga = DB::table('tb_token_prova')->where('token', $token)->
    where('id_prova', $id_prova)->first('id_vaga');

    $id_vaga = $id_vaga->id_vaga;

    $id_candidato = DB::table('tb_candidato')->
    where('id_usuario_candidato', $id_usuario_candidato)->first('id_candidato');

    $id_candidato = $id_candidato->id_candidato;

    $reposta = DB::update('UPDATE tb_candidato_prova SET prova_feita = ?, percentual_acerto = ? 
    WHERE id_vaga = ? AND id_candidato = ? AND id_prova = ?',[1,$percentual,$id_vaga,
    $id_candidato, $id_prova]);

    return $reposta;
  }

  public function contaProvasPendentesCandidato($id_usuario_candidato){
    $id_candidato = DB::table('tb_candidato')
    ->where('id_usuario_candidato', $id_usuario_candidato)
    ->first('id_candidato');
    
    $id_candidato = $id_candidato->id_candidato;
    date_default_timezone_set('America/Sao_Paulo');
    
    $hoje = date('Y-m-d');

    $resposta = DB::table('tb_candidato_prova')
    ->join('tb_token_prova', function($join) use ($hoje, $id_candidato){
      $join->on('tb_token_prova.id_vaga', '=' ,'tb_candidato_prova.id_vaga')
      ->where('tb_candidato_prova.id_candidato', $id_candidato)
      ->where('tb_candidato_prova.prova_feita', 0)
      ->where('tb_token_prova.data_limite','>=', $hoje);
    })
    ->count();

    return $resposta;
  }
}
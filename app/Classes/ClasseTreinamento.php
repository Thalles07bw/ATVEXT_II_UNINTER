<?php

namespace App\Classes;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Classes\ClasseLocais;

class ClasseTreinamento{
  private function checaExistenciaCurso($nomeCurso, $idEmpresa, $idCurso){
    if($idCurso == NULL){
      $resposta = DB::table('tb_curso')
                ->where('nome_curso', $nomeCurso)
                ->where('id_empresa', $idEmpresa)
                ->first();
    }else{
      $resposta = DB::table('tb_curso')
      ->where('nome_curso', $nomeCurso)
      ->where('id_empresa', $idEmpresa)
      ->where('id_curso','<>',$idCurso)
      ->first();
    }
    if($resposta != NULL){
      return true;
    }else{
      return false;
    }
  }
  public function cadastraInstrutor($arrInstrutor){

    $resposta = DB::insert('INSERT INTO tb_instrutor (nome_instrutor, dn_instrutor,
    email_instrutor, numero_telefone, id_genero, id_saudacao, id_estado_civil, cpf_instrutor,
    cnpj_instrutor, id_escolaridade, id_tipo_contrato, id_usuario, area_especialidade_instrutor, 
    possui_deficiencia,tipo_necessidade_especial, id_empresa, instrutor_ativo) 
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
    $arrInstrutor);

    if($resposta == 1){
      $mensagem = "Os dados principais do instrutor foram cadastrados com sucesso !!!";
      $arrResposta = array("flag" => true, "mensagem" => $mensagem);
      return $arrResposta;
    }else{
      $mensagem = "Ocorreu um erro ao inserir o registro";
      $arrResposta = array("flag" => false, "mensagem" => $mensagem);
      return $arrResposta;
    }
  }

  public function buscaInstrutores($id_empresa){

    $resposta = DB::select("SELECT ti.*, u.email_usuario FROM tb_instrutor AS ti, tb_usuario as u
    WHERE u.id_usuario = ti.id_usuario AND id_empresa = ? AND instrutor_ativo = ?", [$id_empresa, 1]);

    return $resposta;
  }

  public function atualizaFoto($id, $nomeArquivo){

    $resposta = DB::update("UPDATE tb_instrutor SET foto_instrutor = ?  WHERE 
    id_instrutor = ?", [$nomeArquivo, $id]);

    return $resposta;
  }

  public function buscaInstrutorPorId($id){
    $resposta = DB::table('tb_instrutor')
                ->where('id_instrutor', $id)
                ->first();

    return $resposta;
  }

  public function editaInstrutor($arrInstrutor){

    $resposta = DB::update('UPDATE tb_instrutor SET nome_instrutor = ?, dn_instrutor = ?,
    email_instrutor = ?, numero_telefone = ?, id_genero = ?, id_saudacao = ?, id_estado_civil = ?, 
    cpf_instrutor = ?, cnpj_instrutor = ?, id_escolaridade = ?, id_tipo_contrato = ?, 
    id_usuario = ?, area_especialidade_instrutor = ?, possui_deficiencia = ?, tipo_necessidade_especial = ? 
    WHERE id_instrutor = ?', $arrInstrutor);

    if($resposta == 1){
      $mensagem = "Os dados principais do instrutor foram atualizados com sucesso !!!";
      $arrResposta = array("flag" => true, "mensagem" => $mensagem);
      return $arrResposta;
    }else{
      $mensagem = "Ocorreu um erro ao atualizar o registro";
      $arrResposta = array("flag" => false, "mensagem" => $mensagem);
      return $arrResposta;
    }
  }

  public function desativaInstrutor($id){
    $resposta = DB::update('UPDATE tb_instrutor SET instrutor_ativo = ? 
    WHERE id_instrutor = ?', [0 , $id]);

    if($resposta == 1){
      $mensagem = "O instrutor foi desativado com sucesso !!!";
      $arrResposta = array("flag" => true, "mensagem" => $mensagem);
      return $arrResposta;
    }else{
      $mensagem = "Ocorreu um erro ao desativar o instrutor";
      $arrResposta = array("flag" => false, "mensagem" => $mensagem);
      return $arrResposta;
    }
  }

  public function cadastraCurso($arrCurso){

    $verificacao = $this->checaExistenciaCurso($arrCurso[0],$arrCurso[8], NULL);

    if($verificacao == false){
      $resposta = DB::insert("INSERT INTO tb_curso (nome_curso, carga_horaria_pratica,
      carga_horaria_teorica, descricao_curso, conteudo_pratico, conteudo_teorico, prazo_validade,
      unidade_prazo_validade, id_empresa)
      VALUES (?,?,?,?,?,?,?,?,?)", $arrCurso);

      if($resposta == 1){
        $mensagem = "O curso foi cadastrado com sucesso !!!";
        $arrResposta = array("flag" => true, "mensagem" => $mensagem);
        return $arrResposta;
      }else{
        $mensagem = "Ocorreu um erro ao cadastrar o curso.";
        $arrResposta = array("flag" => false, "mensagem" => $mensagem);
        return $arrResposta;
      }
    }else{
      $mensagem = "Um curso com este nome já existe.";
      $arrResposta = array("flag" => false, "mensagem" => $mensagem);
      return $arrResposta;
    }
  }

  public function prazosTreinamentos(){
    $resposta = DB::table('tb_unidade_validade_treinamento')->get();

    return $resposta;
  }

  public function buscaCursos($id_empresa){
    $resposta = DB::table('tb_curso')
                ->where('id_empresa', $id_empresa)
                ->get();
    return $resposta;
  }

  public function buscaCursoPorId($id){
    $resposta = DB::table('tb_curso')
                ->where('id_curso', $id)
                ->get();
    return $resposta;
  }

  public function editaCurso($arrCurso){
    $verificacao = $this->checaExistenciaCurso($arrCurso[0],$_SESSION['empresa_usuario'], $arrCurso[8]);

    if($verificacao == false){
      $resposta = DB::update("UPDATE tb_curso SET nome_curso = ?, carga_horaria_pratica = ?,
      carga_horaria_teorica = ?, descricao_curso = ?, conteudo_pratico = ?, conteudo_teorico = ?,
      prazo_validade = ?,unidade_prazo_validade = ? WHERE id_curso = ?", $arrCurso);

      if($resposta == 1){
        $mensagem = "Os dados foram atualizados com sucesso !!!";
        $arrResposta = array("flag" => true, "mensagem" => $mensagem);
        return $arrResposta;
      }else{
        $mensagem = "Não houveram alterações nos dados";
        $arrResposta = array("flag" => true, "mensagem" => $mensagem);
        return $arrResposta;
      }
    }else{
      $mensagem = "Já existe um curso com este nome";
      $arrResposta = array("flag" => false, "mensagem" => $mensagem);
      return $arrResposta;
    }
  }

  public function deletaCurso($id){
    try{
      $resposta = DB::delete("DELETE FROM tb_curso WHERE id_curso = ?", [$id]);
      $mensagem = "O curso foi excluido com sucesso";
    }catch(Exception $e){
      $resposta = false;
      $mensagem = "Impossível excluir o curso, pois existem treinamentos vinculados a ele";
    }
    $arrResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

    return $arrResposta;
  }

  public function buscaStatusTreinamento(){
    $resposta = DB::table('tb_status_treinamento')
    ->get();

    return $resposta;
  }


  public function inserirTreinamento($arrTreinamento, $arrInstrutores, $arrParticipantes){
 

    $id_treinamento = DB::table('tb_treinamento')->insertGetId([
      'id_curso' => $arrTreinamento[0],
      'data_inicio' => $arrTreinamento[1],
      'data_fim' => $arrTreinamento[2],
      'vagas_treinamento' => $arrTreinamento[3],
      'diretor_treinamento' => $arrTreinamento[4],
      'status_treinamento' => $arrTreinamento[5],
      'descricao_treinamento' => $arrTreinamento[6]
    ]);
    
    try{
      if($arrInstrutores == NULL){
        $resposta1 = 1;
      }else{
        foreach ($arrInstrutores as $value){

          $resposta1 = DB::insert('INSERT INTO tb_instrutor_treinamento (id_treinamento, id_instrutor)
          VALUES (?,?)',[$id_treinamento, $value]);
        }
      }
      if($arrParticipantes == NULL){
        $resposta2 = 1;
      }else{
        foreach ($arrParticipantes as $value){
          $resposta2 = DB::insert('INSERT INTO tb_colaborador_treinamento (id_treinamento, id_colaborador)
          VALUES (?,?)',[$id_treinamento, $value]);
        }
      }
    }catch(Exception $e){
      $resposta1 = 0;
      $resposta2 = 0;
    }

    if($resposta1 == 1 && $resposta2 == 1){
      $mensagem = "O treinamento foi cadastrado com sucesso !!!";
      $arrResposta = array("flag" => true, "mensagem" => $mensagem);
      return $arrResposta;
    }else{
      $mensagem = "Ocorreu um erro ao cadastrar o treinamento.";
      $arrResposta = array("flag" => false, "mensagem" => $mensagem);
      return $arrResposta;
    }
  }

  public function editarTreinamento($arrTreinamento){
 
    $resposta = DB::update('UPDATE tb_treinamento SET id_curso = ?, data_inicio = ?, 
    data_fim = ?, vagas_treinamento = ?, diretor_treinamento = ?, status_treinamento = ?, 
    descricao_treinamento = ? WHERE id_treinamento = ?', $arrTreinamento);
    
    if($resposta == 1 ){
      $mensagem = "O treinamento foi atualizado com sucesso !!!";
      $arrResposta = array("flag" => true, "mensagem" => $mensagem);
      return $arrResposta;
    }else{
      $mensagem = "Os dados não foram alterados.";
      $arrResposta = array("flag" => true, "mensagem" => $mensagem);
      return $arrResposta;
    }
  }

  public function editaParticipantes($arrInstrutores, $arrParticipantes, $id_treinamento){
    try{
      if($arrInstrutores == NULL){
        $resposta1 = 1;
      }else{
        DB::delete("DELETE from tb_instrutor_treinamento WHERE id_treinamento = ?", [$id_treinamento]);
        foreach ($arrInstrutores as $value){
          $resposta1 = DB::insert('INSERT INTO tb_instrutor_treinamento (id_treinamento, id_instrutor)
          VALUES (?,?)',[$id_treinamento, $value]);
        }
      }
      if($arrParticipantes == NULL){
        $resposta2 = 1;
      }else{
        DB::delete("DELETE from tb_colaborador_treinamento WHERE id_treinamento = ?", [$id_treinamento]);
        foreach ($arrParticipantes as $value){
          $resposta2 = DB::insert('INSERT INTO tb_colaborador_treinamento (id_treinamento, id_colaborador)
          VALUES (?,?)',[$id_treinamento, $value]);
        }
      }
    }catch(Exception $e){
      $resposta1 = 0;
      $resposta2 = 0;
    }

    if($resposta1 == 1 || $resposta2 == 1){
      $mensagem = "Os participantes foram cadastrados com sucesso !!!";
      $arrResposta = array("flag" => true, "mensagem" => $mensagem);
      return $arrResposta;
    }else{
      $mensagem = "Ocorreu um erro ao cadastrar os participantes.";
      $arrResposta = array("flag" => false, "mensagem" => $mensagem);
      return $arrResposta;
    }
  }

  public function buscaTreinamentos($id_empresa){
    $resposta = DB::select("SELECT tt.*,tcl.nome_colaborador as diretor, tcr.nome_curso FROM 
    tb_treinamento tt, tb_curso tcr, tb_colaborador tcl 
    WHERE  tt.id_curso = tcr.id_curso AND tt.diretor_treinamento = tcl.id_colaborador AND 
    tcr.id_empresa = ?", [$id_empresa]);

    return $resposta;
  }

  public function buscaTreinamentosInstrutor($id_empresa, $id_instrutor){
    $resposta = DB::select("SELECT tt.*,tcl.nome_colaborador as diretor, tcr.nome_curso FROM 
    tb_treinamento tt, tb_curso tcr, tb_colaborador tcl, tb_instrutor_treinamento tit
    WHERE  tt.id_curso = tcr.id_curso AND tt.diretor_treinamento = tcl.id_colaborador AND
    tit.id_treinamento = tt.id_treinamento AND
    tcr.id_empresa = ? AND tit.id_instrutor = ?", [$id_empresa, $id_instrutor]);

    return $resposta;
  }
  public function buscaLocais($id_empresa){
    $resposta = DB::select('SELECT tla.*, te.nome_estado, tc.nome_cidade FROM
    tb_local_aula as tla, tb_cidade as tc, tb_estado as te
    WHERE tc.id_cidade = tla.id_cidade AND te.id_estado = tla.id_estado AND id_empresa = ?', [$id_empresa]);


    return $resposta;
  }

  public function buscaLocalPorId($id){
    $resposta = DB::select('SELECT tla.*, te.nome_estado, tc.nome_cidade FROM
    tb_local_aula as tla, tb_cidade as tc, tb_estado as te
    WHERE tc.id_cidade = tla.id_cidade AND te.id_estado = tla.id_estado AND id_local = ?', [$id]);


    return $resposta;
  }

  public function buscaTreinamentoPorId($id){
    $resposta = DB::table('tb_treinamento')
                ->where('id_treinamento', $id)
                ->first();
    return $resposta;
  }

  public function buscaAlunosTreinamento($id_treinamento){
    $resposta = DB::select("SELECT tcl.id_colaborador as id_aluno, tcl.nome_colaborador as nome_aluno 
    FROM tb_colaborador_treinamento tct, 
    tb_colaborador tcl , tb_treinamento tt, tb_curso tcr WHERE 
    tct.id_colaborador = tcl.id_colaborador AND
    tt.id_curso = tcr.id_curso AND
    tt.id_treinamento = tct.id_treinamento AND 
    tct.id_treinamento = ?", [$id_treinamento]);

    return $resposta;
  }

  public function buscaInstrutoresTreinamento($id_treinamento){
    $resposta = DB::select("SELECT ti.id_instrutor, ti.nome_instrutor  FROM tb_instrutor_treinamento tit, 
    tb_instrutor ti , tb_treinamento tt, tb_curso tc WHERE 
    ti.id_instrutor = tit.id_instrutor AND
    tt.id_curso = tc.id_curso AND
    tt.id_treinamento = tit.id_treinamento AND 
    tit.id_treinamento = ?", [$id_treinamento]);

    return $resposta;
  }

  public function cadastraLocaisAula($arrLocaisAula){

    $ClasseLocais = new ClasseLocais();

    $cidade = $ClasseLocais->buscaIdCidade($arrLocaisAula[6]);
    $cidade = $cidade[0]->id_cidade;
    $estado = $ClasseLocais->buscaIdEstado($arrLocaisAula[7]);
    $estado = $estado[0]->id_estado;

    $arrLocaisAula[6] = $cidade;
    $arrLocaisAula[7] = $estado;

    $resposta = DB::insert("INSERT into tb_local_aula
    (nome_local, nome_sala, cep_local, rua_local, numero_local, 
    bairro_local, id_cidade, id_estado, id_pais, id_empresa ) 
    VALUES (?,?,?,?,?,?,?,?,?,?) ", $arrLocaisAula);
    
    if($resposta == 1){
      $arrResposta = array("flag" => $resposta, "mensagem" => "Local Cadastrado com Sucesso");
    }else{
      $arrResposta = array("flag" => $resposta, "mensagem" => "Falha ao cadastrar o Local");
    }
    
    return $arrResposta;
    
  }

  public function editaLocaisAula($arrLocaisAula){

    $ClasseLocais = new ClasseLocais();

    $cidade = $ClasseLocais->buscaIdCidade($arrLocaisAula[6]);
    $cidade = $cidade[0]->id_cidade;
    $estado = $ClasseLocais->buscaIdEstado($arrLocaisAula[7]);
    $estado = $estado[0]->id_estado;

    $arrLocaisAula[6] = $cidade;
    $arrLocaisAula[7] = $estado;

    $resposta = DB::update("UPDATE tb_local_aula SET
    nome_local = ?, nome_sala = ?, cep_local = ?, rua_local = ?, numero_local = ?, 
    bairro_local = ?, id_cidade = ?, id_estado = ?, id_pais = ?
    WHERE id_local = ? ", $arrLocaisAula);
    
    if($resposta == 1){
      $arrResposta = array("flag" => true, "mensagem" => "Os dados do local foram atualizados");
    }else{
      $arrResposta = array("flag" => true, "mensagem" => "Nenhuma alteração para salvar");
    }
    
    return $arrResposta;
    
  }

  public function excluirLocal($id){
  
    try{
      $resposta = DB::delete("DELETE FROM tb_local_aula WHERE id_local = ?",[$id]);
      $mensagem = "O local de aula foi excluido com sucesso";
    }catch(Exception $e){
      $resposta = false;
      $mensagem = "Impossível excluir o local, pois existem treinamentos vinculados a ele";
    }
    $arrResposta = array('flag' => $resposta, 'mensagem' => $mensagem);

    return $arrResposta;

  }

  public function cadastrarAula($arrAula, $prova){
 
    $resposta = DB::insert("INSERT INTO tb_aula
    (id_instrutor, id_treinamento, id_local, nome_aula, descricao_aula, 
    dia_hora_inicio, dia_hora_fim) 
    VALUES (?,?,?,?,?,?,?) ", $arrAula);

    $id_treinamento = $arrAula[1];
   

    $alunos = DB::table('tb_colaborador_treinamento')
              ->where('id_treinamento', $id_treinamento)
              ->get('id_colaborador');
 

    foreach ($alunos as $aluno){
      DB::insert('INSERT INTO tb_treinamento_prova (id_prova, id_aluno, id_treinamento)
      VALUES (?,?,?)', [$prova, $aluno->id_colaborador, $id_treinamento]);
    }  
    
    if($resposta == 1){
      $arrResposta = array("flag" => $resposta, "mensagem" => "Aula Cadastrada com Sucesso");
    }else{
      $arrResposta = array("flag" => $resposta, "mensagem" => "Falha ao cadastrar a Aula");
    }
    
    return $arrResposta;
  }

  public function buscarAulas($id_instrutor){
    $resposta = DB::table("tb_aula")->where("id_instrutor", $id_instrutor)->get();

    return $resposta;
  }

  public function buscarAulasPorId($id){
    $resposta = DB::table("tb_aula")->where("id_aula", $id)->get();

    return $resposta;
  }

  public function editarAula($arrAula){
 
    $resposta = DB::insert("UPDATE tb_aula SET
    id_treinamento= ?, id_local = ?, nome_aula = ?, descricao_aula = ?, 
    dia_hora_inicio = ?, dia_hora_fim = ? 
    WHERE id_aula = ?", $arrAula);
    
    if($resposta == 1){
      $arrResposta = array("flag" => true, "mensagem" => "Aula Alterada com Sucesso");
    }else{
      $arrResposta = array("flag" => true, "mensagem" => "Nenhuma alteração para salvar");
    }
    
    return $arrResposta;
  }

  public function excluirAula($id){
    $resposta = DB::delete("DELETE FROM tb_aula WHERE id_aula = ?",[$id]);
    
    if($resposta == 1){
      $arrResposta = array("flag" => true, "mensagem" => "Aula Excluída com Sucesso");
    }else{
      $arrResposta = array("flag" => true, "mensagem" => "Falha ao Excluir a aula");
    }
    
    return $arrResposta;
  }

  public function buscaAulasInstrutor($id_instrutor, $data){
    $resposta = DB::select("SELECT tt.descricao_treinamento, ta.*, tla.nome_local, tla.nome_sala FROM 
    tb_aula ta INNER JOIN tb_local_aula tla ON ta.id_local = tla.id_local 
    INNER JOIN tb_treinamento tt ON tt.id_treinamento = ta.id_treinamento 
    WHERE ta.id_instrutor = ? AND DATE(ta.dia_hora_inicio) = ? ORDER BY ta.dia_hora_inicio", [$id_instrutor, $data]);

    return $resposta;
  }

  public function buscaAulasGeral($nome_curso, $nome_instrutor, $data_inicio, $data_fim){
    $resposta = DB::select("SELECT
    tt.descricao_treinamento,
    ta.*,
    tla.nome_local,
    tla.nome_sala,
    tc.nome_curso,
    ti.nome_instrutor 
  FROM
    tb_aula ta
  INNER JOIN tb_local_aula tla ON
    ta.id_local = tla.id_local
  INNER JOIN tb_treinamento tt ON
    tt.id_treinamento = ta.id_treinamento
  INNER JOIN tb_curso tc ON
    tc.id_curso = tt.id_curso
  INNER JOIN tb_instrutor ti ON
    ti.id_instrutor = ta.id_instrutor 
  WHERE
    tc.nome_curso LIKE '%".$nome_curso."%' 
    AND 
    ti.nome_instrutor LIKE '%".$nome_instrutor."%'
    AND 
      (DATE(ta.dia_hora_inicio) BETWEEN '".$data_inicio."' AND '".$data_fim."')
  ORDER BY
    ta.dia_hora_inicio");

    return $resposta;
  }

  public function buscaListaPresença($id_treinamento){
    $resposta = DB::select("SELECT tc.id_colaborador,tc.nome_colaborador, tt.descricao_treinamento FROM tb_colaborador tc 
    INNER JOIN tb_colaborador_treinamento tct ON tct.id_colaborador = tc.id_colaborador
    INNER JOIN tb_treinamento tt ON tt.id_treinamento = tct.id_treinamento 
    AND tct.id_treinamento = ?", [$id_treinamento]);

    return $resposta;
  }

  public function buscaDiretrizes($id_empresa){
    $resposta = DB::table('tb_diretriz')
                ->where('id_empresa', $id_empresa)
                ->get();
    return $resposta;
  }

  public function cadastraDiretriz($arrDiretriz){
    $resposta = DB::insert("INSERT INTO tb_diretriz (titulo_diretriz, descricao_diretriz, id_empresa) 
    VALUES (?,?,?)", $arrDiretriz);
  
    if($resposta == 1){
      $arrResposta = array("flag" => $resposta, "mensagem" => "Diretriz Cadastrada com Sucesso");
    }else{
      $arrResposta = array("flag" => $resposta, "mensagem" => "Falha ao cadastrar a diretriz");
    }

    return $arrResposta;
  }

  public function buscaDiretrizPorId($id){
    $resposta = DB::table('tb_diretriz')
                ->where('id_diretriz', $id)
                ->first();
    
    return $resposta;
  }

  public function editaDiretriz($arrDiretriz){
    $resposta = DB::update("UPDATE tb_diretriz SET titulo_diretriz = ?, descricao_diretriz = ?
    WHERE id_diretriz = ?", $arrDiretriz);
  
    if($resposta == 1){
      $arrResposta = array("flag" => true, "mensagem" => "Diretriz Atualizada com Sucesso");
    }else{
      $arrResposta = array("flag" => true, "mensagem" => "Nenhuma Alteração para salvar");
    }

    return $arrResposta;
  }

  public function excluirDiretriz($id){
    $resposta = DB::delete('DELETE FROM tb_diretriz WHERE id_diretriz = ?',[$id]);

    return $resposta;
  }

  public function buscaListaPresençaStatus($id_treinamento, $id_aula){
    $resposta = DB::select("SELECT tc.id_colaborador, tc.nome_colaborador, tpa.status_aluno FROM 
    tb_colaborador tc INNER JOIN
    tb_colaborador_treinamento tct ON tct.id_colaborador = tc.id_colaborador	
    AND tct.id_treinamento = ? 
    LEFT JOIN tb_presenca_aula tpa ON tpa.id_aluno = tc.id_colaborador
    AND tpa.id_aula = ?", [$id_treinamento, $id_aula]);

    return $resposta;
  }

  public function registrarPresenca($arrPresenca){
    if(DB::table('tb_presenca_aula')
      ->where('id_aula', $arrPresenca[1])
      ->where('id_aluno', $arrPresenca[0])->first()){

      DB::update('UPDATE tb_presenca_aula SET status_aluno = ? 
      WHERE id_aula = ? AND id_aluno = ?',[$arrPresenca[2],$arrPresenca[1],$arrPresenca[0]]);
    
    }else{
      
      DB::insert('INSERT INTO tb_presenca_aula (id_aluno, id_aula, status_aluno)
      VALUES (?,?,?)',$arrPresenca);
      
    }
    $treinamento = DB::table('tb_aula')->where('id_aula', $arrPresenca[1])->first('id_treinamento');
    $treinamento = $treinamento->id_treinamento;

    $quantidade_treinamento = DB::table('tb_colaborador_treinamento')
                              ->where('id_treinamento', $treinamento)
                              ->count();
    $quantidade_registrada = DB::table('tb_presenca_aula')
                              ->where('id_aula', $arrPresenca[1])
                              ->count();    
    if($quantidade_registrada == $quantidade_treinamento){
      DB::update('UPDATE tb_aula SET aula_dada = 1 WHERE id_aula = ?', [$arrPresenca[1]]);
    }
    if($arrPresenca[2] == 1){
      return "Presente";
    }else{
      return "Falta";
    }
  }

  public function percentualTreinamentoConcluido ($id_treinamento){

    $resposta = DB::select("SELECT total.id_treinamento,total.descricao_treinamento, (dadas.qtd/total.qtd)*100 as percentual
    FROM
    (
    SELECT
      t.id_treinamento,
      t.descricao_treinamento,
      COUNT(a.id_aula) as qtd
    FROM
      tb_treinamento t
    INNER JOIN tb_aula a 
    ON
      t.id_treinamento = a.id_treinamento
    GROUP BY t.id_treinamento, t.descricao_treinamento
    ) AS total,
    (SELECT
      t.id_treinamento,
      t.descricao_treinamento,
      COUNT(a.id_aula) as qtd
    FROM
      tb_treinamento t
    INNER JOIN tb_aula a 
    ON
      t.id_treinamento = a.id_treinamento
    WHERE
      a.aula_dada = 1
    GROUP BY t.id_treinamento,t.descricao_treinamento) AS dadas
    WHERE dadas.descricao_treinamento = total.descricao_treinamento
    AND total.id_treinamento = ?", [$id_treinamento]);

    return $resposta;
  }

  public function situacaoDosAlunos($id_treinamento){
    if($_SESSION['permissao'] == 1){
      $resposta = DB::select('SELECT 	
      total.id_colaborador,
      total.id_usuario,
      total.nome_colaborador,
      total.id_treinamento,
      parcial.qtd_presencas,
      total.qtd_aulas,
      certificado.caminho_arquivo
      FROM
      (SELECT
        tc.id_colaborador,
        tc.nome_colaborador,
        tc.id_usuario,
        tt.id_treinamento,
        COUNT(tc.id_colaborador) as qtd_aulas
      FROM
        tb_treinamento tt
      INNER JOIN 
      tb_colaborador_treinamento tct on
        tct.id_treinamento = tt.id_treinamento
      INNER JOIN
      tb_colaborador tc on
        tc.id_colaborador = tct.id_colaborador
      INNER JOIN 
      tb_aula ta on
        ta.id_treinamento = tt.id_treinamento 
      GROUP BY tc.id_colaborador, tc.nome_colaborador, tc.id_usuario,tt.id_treinamento) as total
      INNER JOIN
      (SELECT
        tc.id_colaborador,
        tc.nome_colaborador,
        tt.id_treinamento,
        COUNT(DISTINCT tpa.id_aula) as qtd_presencas
      FROM
      tb_colaborador tc
      INNER JOIN 
      tb_presenca_aula tpa ON
        tpa.id_aluno = tc.id_colaborador
      INNER JOIN tb_aula ta ON
        ta.id_aula = tpa.id_aula
      INNER JOIN tb_treinamento tt ON
        tt.id_treinamento = ta.id_treinamento 
      WHERE tpa.status_aluno = 1
      GROUP BY tc.id_colaborador, tc.nome_colaborador, tc.id_usuario,tt.id_treinamento) as parcial  
      ON total.id_colaborador = parcial.id_colaborador AND total.id_treinamento = parcial.id_treinamento
      LEFT JOIN
      (SELECT taa.caminho_arquivo, tc.id_colaborador  FROM tb_arquivos_armazenados as taa INNER JOIN tb_colaborador tc  ON tc.id_colaborador = taa.id_aluno
	   where id_tipo_arquivo = 1) as certificado
	   ON total.id_colaborador = certificado.id_colaborador
      WHERE total.id_treinamento = ?',[$id_treinamento]);
    }else{
      $resposta = DB::select('SELECT 	
      total.id_colaborador,
      total.nome_colaborador,
      total.id_treinamento,
      total.id_usuario,
      parcial.qtd_presencas,
      total.qtd_aulas,
      certificado.caminho_arquivo
      FROM
      (SELECT
        tc.id_colaborador,
        tc.id_usuario,
        tc.nome_colaborador,
        tt.id_treinamento,
        COUNT(tc.id_colaborador) as qtd_aulas
      FROM
        tb_treinamento tt
      INNER JOIN 
      tb_colaborador_treinamento tct on
        tct.id_treinamento = tt.id_treinamento
      INNER JOIN
      tb_colaborador tc on
        tc.id_colaborador = tct.id_colaborador
      INNER JOIN 
      tb_aula ta on
        ta.id_treinamento = tt.id_treinamento 
      GROUP BY tc.id_colaborador, tt.id_treinamento) as total
      INNER JOIN
      (SELECT
        tc.id_colaborador,
        tc.nome_colaborador,
        tt.id_treinamento,
        COUNT(DISTINCT tpa.id_aula) as qtd_presencas
      FROM
      tb_colaborador tc
      INNER JOIN 
      tb_presenca_aula tpa ON
        tpa.id_aluno = tc.id_colaborador
      INNER JOIN tb_aula ta ON
        ta.id_aula = tpa.id_aula
      INNER JOIN tb_treinamento tt ON
        tt.id_treinamento = ta.id_treinamento 
      WHERE tpa.status_aluno = 1
      GROUP BY tc.id_colaborador, tt.id_treinamento) as parcial  
      ON total.id_colaborador = parcial.id_colaborador AND total.id_treinamento = parcial.id_treinamento
      LEFT JOIN
      (SELECT taa.caminho_arquivo, tc.id_colaborador  FROM tb_arquivos_armazenados as taa INNER JOIN tb_colaborador tc  ON tc.id_colaborador = taa.id_aluno
	   where id_tipo_arquivo = 1) as certificado
	   ON total.id_colaborador = certificado.id_colaborador
      WHERE total.id_treinamento = ? AND total.id_usuario = ?',[$id_treinamento, $_SESSION['id_usuario']]);
    }

    return $resposta;
    
  }

  public function buscaTipoArquivo(){
    
    $resposta = DB::table('tb_tipo_arquivo')->get();
    
    return $resposta;
  }

  public function cadastrarArquivos($arrArquivos){
    $resposta = DB::insert("INSERT INTO tb_arquivos_armazenados 
    (id_treinamento, id_aluno, id_tipo_arquivo, caminho_arquivo) VALUES (?,?,?,?)", $arrArquivos);

    return $resposta;
  }

  public function buscaArquivosTreinamento($id_empresa){
    $resposta = DB::select('SELECT
      nome_colaborador,
      descricao_treinamento,
      nome_tipo_arquivo,
      caminho_arquivo
    FROM
      tb_arquivos_armazenados taa
    INNER JOIN tb_colaborador tc on
      taa.id_aluno = tc.id_colaborador
    INNER JOIN tb_tipo_arquivo tta on
      tta.id_tipo_arquivo = taa.id_tipo_arquivo 
    INNER JOIN tb_treinamento tt on
      tt.id_treinamento = taa.id_treinamento
    INNER JOIN tb_curso tc2 on
      tc2.id_curso = tt.id_curso
    WHERE tc2.id_empresa = ?', [$id_empresa]);

    return $resposta;
  }

  public function buscaQuestoesPesquisaSatisfacao(){
    $resposta = DB::table('tb_pergunta_pesquisa_satisfacao')->get();
    
    return $resposta;
  }

  public function buscaCertificadoUsuario($id_treinamento){
    $resposta = DB::select("SELECT taa.caminho_arquivo  FROM tb_arquivos_armazenados as taa INNER JOIN tb_colaborador tc  ON tc.id_colaborador = taa.id_aluno
    where id_tipo_arquivo = 1 AND tc.id_usuario = ? AND taa.id_treinamento", [$_SESSION['id_usuario'], $id_treinamento]);

    return $resposta;
  }
  
}
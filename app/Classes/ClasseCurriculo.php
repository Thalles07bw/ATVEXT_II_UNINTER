<?php
namespace App\Classes;


use Illuminate\Support\Facades\DB;
class ClasseCurriculo{

  
  public function buscaDadosUsuario($id_candidato){
    $resposta = DB::table('tb_usuario_candidato')->where('id_usuario_candidato', $id_candidato)->first();

    return $resposta;
  }

  public function buscaDadosCurriculo($id_candidato){
    $resposta = DB::table('tb_candidato')->where('id_usuario_candidato', $id_candidato)->first();

    return $resposta;
  }

  public function buscaGeneros(){
    $resposta = DB::table('tb_genero')->get();

    return $resposta;
  }

  public function buscaEstadoCivil(){
    $resposta = DB::table('tb_estado_civil')->get();

    return $resposta;
  }

  public function buscaIdiomas(){
    $resposta = DB::table('tb_idioma')->get();
    
    return $resposta;
  }
  public function salvaPrincipaisCurriculo($dadosCurriculo){
   
    $existe_curriculo = DB::table('tb_candidato')->where('id_usuario_candidato', $dadosCurriculo[18])->first();
    

    $estado = DB::table('tb_estado')->where('nome_estado', $dadosCurriculo[16])->first('id_estado');
    $cidade = DB::table('tb_cidade')->where('id_estado', $estado->id_estado)->where('nome_cidade', $dadosCurriculo[17])->first('id_cidade');
    
    
    if($existe_curriculo == NULL){
      
      $resposta = DB::insert('INSERT INTO tb_candidato (dial_code_telefone, numero_telefone,
      dial_code_whatsapp, numero_whatsapp, email_candidato, id_genero, dn_candidato, id_estado_civil,
      id_senioridade, possui_deficiencia, tipo_necessidade_especial, id_pais, cep_candidato,
      logradouro_candidato, numero_endereco_candidato, bairro_candidato, id_estado, id_cidade, 
      id_usuario_candidato) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
      [$dadosCurriculo[0],$dadosCurriculo[1],$dadosCurriculo[2],$dadosCurriculo[3],$dadosCurriculo[4],
      $dadosCurriculo[5],$dadosCurriculo[6],$dadosCurriculo[7],$dadosCurriculo[8],$dadosCurriculo[9],
      $dadosCurriculo[10],$dadosCurriculo[11],$dadosCurriculo[12],$dadosCurriculo[13],$dadosCurriculo[14],
      $dadosCurriculo[15],$estado->id_estado, $cidade->id_cidade,$dadosCurriculo[18]]);

      $arrayResposta =  array('resposta' => $resposta, 'primeiro_cadastro' => true);

      return $arrayResposta;

    }else{
      $resposta = DB::update('UPDATE tb_candidato SET dial_code_telefone = ?, numero_telefone = ?,
      dial_code_whatsapp = ?, numero_whatsapp = ?, email_candidato = ?, id_genero = ?, 
      dn_candidato = ?, id_estado_civil = ?, id_senioridade = ?, possui_deficiencia = ?,
      tipo_necessidade_especial = ?, id_pais = ?, cep_candidato = ?, logradouro_candidato = ?,
      numero_endereco_candidato = ?, bairro_candidato = ?, id_estado = ?, id_cidade = ? WHERE 
      id_usuario_candidato = ?',
      [$dadosCurriculo[0],$dadosCurriculo[1],$dadosCurriculo[2],$dadosCurriculo[3],$dadosCurriculo[4],
      $dadosCurriculo[5],$dadosCurriculo[6],$dadosCurriculo[7],$dadosCurriculo[8],$dadosCurriculo[9],
      $dadosCurriculo[10],$dadosCurriculo[11],$dadosCurriculo[12],$dadosCurriculo[13],$dadosCurriculo[14],
      $dadosCurriculo[15],$estado->id_estado, $cidade->id_cidade,$dadosCurriculo[18]]);
      
       $arrayResposta = array('resposta' => $resposta, 'primeiro_cadastro' => false);

       return $arrayResposta;
    }
  }
  public function cadastraIdiomaCandidato($dadosIdioma){

    $id_candidato = DB::table('tb_candidato')->where('id_usuario_candidato', $dadosIdioma[0])->get('id_candidato')->first();
    $id_candidato = $id_candidato->id_candidato;

    $idiomaExiste = DB::table('tb_idioma_candidato')->where('id_candidato', $id_candidato)->where('id_idioma', $dadosIdioma[1])->first();
    if($idiomaExiste != NULL){
      $resposta = false;
      return $resposta;
    }else{
      $resposta = DB::insert("INSERT INTO tb_idioma_candidato (id_candidato, id_idioma, nivel_idioma_candidato)
      VALUES (?,?,?)",[$id_candidato,$dadosIdioma[1],$dadosIdioma[2]]);

      return $resposta;
    }
  }

  public function buscaIdiomasCandidato($id_usuario_candidato){
    $id_candidato = DB::table('tb_candidato')->where('id_usuario_candidato', $id_usuario_candidato)->get('id_candidato')->first();
    $id_candidato = $id_candidato->id_candidato;

    $resposta = DB::select('SELECT tic.id_idioma_candidato,ti.idioma, tic.nivel_idioma_candidato FROM tb_candidato tc, tb_idioma ti , tb_idioma_candidato tic WHERE ti.id_idioma = tic.id_idioma 
    AND tc.id_candidato = tic.id_candidato AND tc.id_candidato = ?', [$id_candidato]);

    return $resposta;
  }

  public function salvarAlteracoesNivelIdioma($id,$nivel){
    $resposta = DB::update("UPDATE tb_idioma_candidato SET nivel_idioma_candidato = ? WHERE 
    id_idioma_candidato = ?",[$nivel,$id]);

    return $resposta;
  }

  public function deletaIdiomaCandidato($id){
    $resposta = DB::delete("DELETE FROM tb_idioma_candidato WHERE id_idioma_candidato = ?",[$id]);

    return $resposta;
  }

  public function buscaHabilidadesCandidato($id_usuario_candidato){
    $id_candidato = DB::table('tb_candidato')->where('id_usuario_candidato', $id_usuario_candidato)->get('id_candidato')->first();
    $id_candidato = $id_candidato->id_candidato;

    $resposta = DB::select('SELECT thc.id_habilidade_candidato, thc.habilidade_candidato, thc.nivel_habilidade_candidato FROM tb_candidato tc, tb_habilidade_candidato thc WHERE tc.id_candidato = thc.id_candidato
    AND tc.id_candidato = ?', [$id_candidato]);

    return $resposta;
  }

  public function cadastraHabilidadeCandidato($dadosHabilidade){

    $id_candidato = DB::table('tb_candidato')->where('id_usuario_candidato', $dadosHabilidade[0])->get('id_candidato')->first();
    $id_candidato = $id_candidato->id_candidato;

    $habilidadeExiste = DB::table('tb_habilidade_candidato')->where('id_candidato', $id_candidato)->where('habilidade_candidato', $dadosHabilidade[1])->first();
    if($habilidadeExiste != NULL){
      $resposta = false;
      return $resposta;
    }else{
      $resposta = DB::insert("INSERT INTO tb_habilidade_candidato (id_candidato, habilidade_candidato, nivel_habilidade_candidato)
      VALUES (?,?,?)",[$id_candidato,$dadosHabilidade[1],$dadosHabilidade[2]]);

      return $resposta;
    }
  }

  public function salvarAlteracoesNivelHabilidade($id,$nivel){
    $resposta = DB::update("UPDATE tb_habilidade_candidato SET nivel_habilidade_candidato = ? WHERE 
    id_habilidade_candidato = ?",[$nivel,$id]);

    return $resposta;
  }

  public function deletaHabilidadeCandidato($id){
    $resposta = DB::delete("DELETE FROM tb_habilidade_candidato WHERE id_habilidade_candidato = ?",[$id]);

    return $resposta;
  }

  public function buscaNiveisFormacao(){
    $resposta = DB::table('tb_escolaridade')->get();

    return $resposta;
  }

  public function buscaFormacoesCandidato($id_usuario_candidato){
    $id_candidato = DB::table('tb_candidato')->where('id_usuario_candidato', $id_usuario_candidato)->get('id_candidato')->first();
    $id_candidato = $id_candidato->id_candidato;

    $resposta = DB::select("SELECT  tfc.id_formacao_candidato,tfc.curso_formacao_candidato,te.nome_escolaridade, tfc.data_fim_formacao
    FROM tb_escolaridade te , tb_formacao_candidato tfc WHERE te.id_escolaridade = tfc.id_escolaridade
    AND tfc.id_candidato = ?", [$id_candidato]);

    return $resposta;
  }

  public function cadastraNovaFormacao($dadosFormação){
    $id_candidato = DB::table('tb_candidato')->where('id_usuario_candidato', $dadosFormação[6])->get('id_candidato')->first();
    $dadosFormação[6] = $id_candidato->id_candidato;

    $resposta = DB::insert("INSERT INTO tb_formacao_candidato (curso_formacao_candidato,
    instituicao_formacao_candidato, id_escolaridade, data_inicio_formacao, data_fim_formacao,
    descricao_formacao_candidato, id_candidato) VALUES (?,?,?,?,?,?,?)", $dadosFormação);

    return $resposta;
    
  }

  public function buscaDadosFormacao($id){
    $resposta = DB::select("SELECT * FROM tb_formacao_candidato WHERE id_formacao_candidato = ?", [$id]);

    return $resposta;
  }

  public function deletaFormacaoCandidato($id){

    $resposta = DB::delete("DELETE FROM tb_formacao_candidato WHERE id_formacao_candidato = ?",[$id]);

    return $resposta;
  }

  public function editarFormacaoCandidato($dadosFormação){
    $resposta = DB::update("UPDATE tb_formacao_candidato SET curso_formacao_candidato = ?,
    instituicao_formacao_candidato = ?, id_escolaridade = ?, data_inicio_formacao = ?,
    data_fim_formacao = ?, descricao_formacao_candidato = ?  WHERE 
    id_formacao_candidato = ?", $dadosFormação);

    return $resposta;
  }

  public function atualizaFoto($caminho){
    $caminho = '/storage/app/'.$caminho;

    $resposta = DB::update("UPDATE tb_candidato SET foto_candidato = ?  WHERE 
    id_usuario_candidato = ?", [$caminho, $_SESSION['id_usuario_candidato']]);

    return $resposta;
  }
  public function buscaCategoriasCNH(){
    $resposta = DB::table('tb_categoria_cnh')->get();
    
    return $resposta;
  }
  public function buscaCNHcandidato($id_usuario_candidato){
    $id_candidato = DB::table('tb_candidato')->where('id_usuario_candidato', $id_usuario_candidato)->get('id_candidato')->first();
    if($id_candidato != NULL){
      $id_candidato = $id_candidato->id_candidato;
      $resposta = DB::table('tb_categoria_cnh_candidato')->where('id_candidato', $id_candidato)->first();
      return $resposta;
    }else{
      return NULL;
    }
  }
  public function salvaCNHCandidato($dadosCNH){
    $id_candidato = DB::table('tb_candidato')->where('id_usuario_candidato', $dadosCNH[3])->get('id_candidato')->first();
    $id_candidato = $id_candidato->id_candidato;
    $existe_cnh = DB::table('tb_categoria_cnh_candidato')->where('id_candidato', $id_candidato)->first();

    if($existe_cnh == NULL){

      $resposta = DB::insert("INSERT INTO tb_categoria_cnh_candidato (id_categoria_cnh, num_registro,
       data_primeira_habilitacao, id_candidato) VALUES (?,?,?,?)", 
       [$dadosCNH[0],$dadosCNH[1],$dadosCNH[2],$id_candidato]);

       return $resposta;
    }else{
      $resposta = DB::update("UPDATE tb_categoria_cnh_candidato SET id_categoria_cnh = ?, num_registro = ?,
      data_primeira_habilitacao = ? WHERE id_candidato = ?", 
      [$dadosCNH[0],$dadosCNH[1],$dadosCNH[2],$id_candidato]);

      return $resposta;
    }
  }

  public function buscaIdUsuarioCandidato($id){
    
    $resposta = DB::table('tb_candidato')
                ->where('id_candidato', $id)
                ->first('id_usuario_candidato');
    
    return $resposta;
  }

}
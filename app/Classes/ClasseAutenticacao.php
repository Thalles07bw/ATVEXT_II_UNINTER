<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;

class ClasseAutenticacao{
  public function checaAutenticacao(){
    if(!isset($_SESSION['id_usuario'])){
      header("Location: /teste/login");
      exit;
    }
  }
  public function checaAutenticacaoCandidato(){
    if(!isset($_SESSION['id_usuario_candidato'])){
      header("Location: /teste/login-candidato");
      exit;
    }
  }

  public function checaAutenticacaoAluno(){
    if(!isset($_SESSION['id_usuario_aluno'])){
      header("Location: /teste/login");
      exit;
    }
  }

  public function checaValidadeProva($id_prova, $token){
    date_default_timezone_set('America/Sao_Paulo');
    $hoje = strtotime(date('Y-m-d 23:59:59'));
    $data_limite_prova = DB::table('tb_token_prova')->where('id_prova', $id_prova)->
    where('token', $token)->first('data_limite');
    if($data_limite_prova != NULL){
      $data_limite_prova = strtotime($data_limite_prova->data_limite.' 23:59:59');
      if($hoje > $data_limite_prova){
        header("Location: /teste/avaliacoes-candidato");
        exit;
      }
    }else{
      header("Location: /teste/avaliacoes-candidato");
      exit;
    } 
  }

  public function checaCandidatoProva($id_usuario_candidato, $id_prova, $token){
    //Busca o id da vaga
    $id_vaga = DB::table('tb_token_prova')->where('token', $token)->first('id_vaga');
    $id_vaga = $id_vaga->id_vaga;
    
    //Busca o id do candidato
    $id_candidato = DB::table('tb_candidato')->
    where('id_usuario_candidato', $id_usuario_candidato)->first('id_candidato');
    $id_candidato = $id_candidato->id_candidato;
  
    //Busca se a prova pertence ao candidato ou se ele já a fez
    $prova_candidato = DB::table('tb_candidato_prova')->where('id_vaga', $id_vaga)->
    where('id_candidato', $id_candidato)->where('id_prova', $id_prova)->first('prova_feita');
    if($prova_candidato != NULL){
      $checaProvaFeita = $prova_candidato->prova_feita;
      if($checaProvaFeita == 1){
        header("Location: /teste/avaliacoes-candidato");
        exit;
      }
    }else{
      header("Location: /teste/avaliacoes-candidato");
      exit;
    }

  }

  public function checaAlunoProva($id_usuario_aluno, $id_prova, $id_treinamento){
    
    //Busca o id do candidato
    $id_aluno = DB::table('tb_aluno')->
    where('id_usuario_aluno', $id_usuario_aluno)->first('id_aluno');
    $id_aluno = $id_aluno->id_aluno;
  
    //Busca se a prova pertence ao candidato ou se ele já a fez
    $prova_aluno = DB::table('tb_treinamento_prova')->where('id_treinamento', $id_treinamento)->
    where('id_aluno', $id_aluno)->where('id_prova', $id_prova)->first('prova_feita');
    if($prova_aluno != NULL){
      $checaProvaFeita = $prova_aluno->prova_feita;
      if($checaProvaFeita == 1){
        header("Location: /teste/avaliacoes-aluno");
        exit;
      }
    }else{
      header("Location: /teste/avaliacoes-aluno");
      exit;
    }

  }
}
?>
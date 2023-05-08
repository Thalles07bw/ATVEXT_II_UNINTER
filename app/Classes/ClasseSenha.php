<?php
namespace App\Classes;

use App\Classes\ClasseLogin;
use App\Classes\ClasseEmail;
use App\Classes\ClasseToken;
use Illuminate\Support\Facades\DB;

class ClasseSenha{
  public function enviarEmail($endereço){

    $email = new ClasseEmail();
    $busca_usuario = new ClasseLogin();
    $token = new ClasseToken();
    $usuario = $busca_usuario->buscaUsuario($endereço);

    if($usuario != NULL && $usuario->usuario_ativo == 1 && $usuario->usuario_validado == 1){
      $valor_token = $token->geraToken();

      DB::insert('INSERT INTO tb_token_senha (token, usuario_token) 
      VALUES (?,?)', array($valor_token, $usuario->id_usuario));
      $endereço_local = '189.126.111.90';
      $assunto = utf8_decode('Recuperação de senha');
      $corpo = utf8_decode("<p>Aqui está o link para a recuperação da sua senha 
      <br><b> Link: </b><a href='http://".$endereço_local."/teste/nova-senha?token=".$valor_token."'>
      Clique Aqui</a></p>");

      $resposta_envio = $email->conectarEmail($endereço,$assunto,$corpo);
      
      if($resposta_envio == true){

        $flag_resposta = true;
        $mensagem = "Um link para alterar a senha foi enviado para o e-mail.
        Cheque também a sua caixa de spam.";
        $resposta = array ('flag' => $flag_resposta,'mensagem' => $mensagem);

        echo json_encode($resposta, JSON_UNESCAPED_UNICODE);
      }else{
        $hipotese_falha = 1;
        $flag_resposta = false; 
        $mensagem = "A Mensagem não pode ser enviada por um erro interno.";
        $resposta = array ('falha' => $hipotese_falha,'flag' => $flag_resposta,'mensagem' => $mensagem);

        echo json_encode($resposta, JSON_UNESCAPED_UNICODE);
      }
      
    }else if($usuario == NULL){
      $hipotese_falha = 2;
      $flag_resposta = false;
      $mensagem = "Usuário não encontrado.";
      $resposta = array ('falha'=> $hipotese_falha,'flag' => $flag_resposta,'mensagem' => $mensagem);
      
      echo json_encode($resposta, JSON_UNESCAPED_UNICODE);

    }else if($usuario->usuario_validado == 0){
      $hipotese_falha = 3;
      $flag_resposta = false;
      $mensagem = "Usuário ainda não está validado, cadastre sua senha com o link enviado ao e-mail.";
      $resposta = array ('falha'=> $hipotese_falha,'flag' => $flag_resposta,'mensagem' => $mensagem);

      echo json_encode($resposta, JSON_UNESCAPED_UNICODE);

    }else if($usuario->usuario_ativo == 0){
      $hipotese_falha = 4;
      $flag_resposta = false;
      $mensagem = "Usuário desativado, use nossos meios e entre em contato.";
      $resposta = array ('falha'=> $hipotese_falha,'flag' => $flag_resposta,'mensagem' => $mensagem);

      echo json_encode($resposta, JSON_UNESCAPED_UNICODE);

    }
  }
  public function cadastrarNovaSenha($token, $nova_senha){

    $token_data = DB::table('tb_token_senha')->where('token', $token)->first();

    if($token_data != NULL){
      $flag_resposta = DB::update('UPDATE tb_usuario set senha_usuario = md5(?), usuario_ativo = ?,usuario_validado = ? where id_usuario = ?', 
      array ($nova_senha,1,1, $token_data->usuario_token));
    }else{
      $flag_resposta = false;
    }

    if($flag_resposta == true){
      $mensagem = "Sua senha foi alterada com sucesso.";
      $resposta = array ('flag' => $flag_resposta,'mensagem' => $mensagem);

    }else if($flag_resposta == false && $token_data != NULL){
      $hipotese_falha = 1;
      $mensagem = "A senha nova não pode ser igual a senha antiga.";
      $resposta = array ('falha' => $hipotese_falha,'flag' => $flag_resposta,'mensagem' => $mensagem);

    }else if ($flag_resposta == false && $token_data == NULL){
      $hipotese_falha = 2;
      $mensagem = "O código de verificação é inválido.";
      $resposta = array ('falha' => $hipotese_falha, 'flag' => $flag_resposta,'mensagem' => $mensagem);
    }
    echo json_encode($resposta, JSON_UNESCAPED_UNICODE);
  }
}
?>

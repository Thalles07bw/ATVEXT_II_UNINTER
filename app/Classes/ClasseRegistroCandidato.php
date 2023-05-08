<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;
use App\Classes\ClasseEmail;
use App\Classes\ClasseToken;

class ClasseRegistroCandidato{

  public function cadastroInicialCandidato($nome_cliente,  $email, $cpf){
    
    $inserted_id = DB::table('tb_usuario_candidato')->insertGetId(
      ['nome_usuario_candidato'=> $nome_cliente,
       'email_usuario_candidato' => $email,
       'cpf_usuario_candidato' => $cpf,
       'id_perfil_usuario' => 2,
       'usuario_candidato_ativo' => 0,
       'usuario_candidato_validado' => 0

      ]);

      $enviar_email = new ClasseEmail();
      $token = new ClasseToken();
      $valor_token = $token->geraToken();
      $endereço_local = '127.0.0.1';
      $assunto = utf8_decode('Criação de senha de acesso');
      $corpo = utf8_decode("<p>Aqui está o link para a criar sua senha de acesso 
      <br><b> Link: </b><a href='http://".$endereço_local."/teste/nova-senha-candidato?token=".$valor_token."'>
      Clique Aqui</a></p>");

      DB::insert('INSERT INTO tb_token_senha_candidato (token_candidato, usuario_candidato_token) 
      VALUES (?,?)', array($valor_token, $inserted_id));

      $enviar_email->conectarEmail($email,$assunto,$corpo);
      
      $mensagem = "O usuário foi cadastrado com sucesso";
      echo json_encode(["flag" => true, "mensagem" => $mensagem ]);
    
  }  
}
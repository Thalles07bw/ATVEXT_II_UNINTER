<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;
use App\Classes\ClasseEmail;
use App\Classes\ClasseToken;

class ClasseRegistro{
 
  public function buscaTiposCliente(){
    
    $tipo_cliente = DB::table('tb_tipo_cliente')->get();
    return $tipo_cliente;
  }

  public function buscaTamanhoEmpresa(){
    
    $tamanho_empresa = DB::table('tb_tamanho_empresa')->get();
    return $tamanho_empresa;
  }

  public function cadastroInicialEmpresa($nome_empresa, $numero_telefone, $id_pais, $id_cidade, 
  $id_estado, $id_tam_empresa, $tipo_cliente ){
   
    $inserted_id = DB::table('tb_empresa_contratante')->insertGetId(
    ['razao_social_empresa_contratante'=> $nome_empresa,
      'dial_code_telefone' => 1,
      'numero_telefone' => $numero_telefone,
      'dial_code_celular' => 1,
      'id_tipo_cliente' => $tipo_cliente,
      'id_pais' => $id_pais,
      'id_estado' => $id_estado,
      'id_cidade'=> $id_cidade,
      'id_tamanho_empresa' => $id_tam_empresa
    ]);

    return $inserted_id; 
  }

  public function cadastroInicialCliente($nome_cliente, $numero_cliente, $id_empresa, $email){
 
    $inserted_id = DB::table('tb_usuario')->insertGetId(
      ['nome_usuario'=> $nome_cliente,
       'email_usuario' => $email,
       'dial_code_tel_usuario' => 1,
       'numero_tel_usuario' => $numero_cliente,

       'id_perfil_usuario' => 1,
       'id_empresa_contratante' => $id_empresa,
       'usuario_ativo' => 1,
       'usuario_validado' => 0

      ]);

      $enviar_email = new ClasseEmail();
      $token = new ClasseToken();
      $valor_token = $token->geraToken();
      $endereço_local = '189.126.111.90';
      $assunto = utf8_decode('Criação de senha de acesso');
      $corpo = utf8_decode("<p>Aqui está o link para a criar sua senha de acesso 
      <br><b> Link: </b><a href='http://".$endereço_local."/nova-senha?token=".$valor_token."'>
      Clique Aqui</a></p>");

      DB::insert('INSERT INTO tb_token_senha (token, usuario_token) 
      VALUES (?,?)', array($valor_token, $inserted_id));

      $enviar_email->conectarEmail($email,$assunto,$corpo);
      
      $mensagem = "O usuário foi cadastrado com sucesso";
      echo json_encode(["flag" => true, "mensagem" => $mensagem ]);
    
  }  
}
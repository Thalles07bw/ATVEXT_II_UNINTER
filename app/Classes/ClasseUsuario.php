<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;
use App\Classes\ClasseEmail;
use App\Classes\ClasseToken;

class ClasseUsuario{
  private function checaAdministradores($id){
    $admin = DB::table('tb_usuario')
    ->where('id_usuario', $id)
    ->where('id_perfil_usuario', 1)
    ->count();
    
    $quantidade = DB::table('tb_usuario')
    ->where('usuario_ativo', 1)
    ->where('id_perfil_usuario', 1)
    ->where('id_empresa_contratante', $_SESSION['empresa_usuario'])
    ->count();
    if($admin == 1 && $quantidade == 1){
      return false;
    }else{
      return true;
    }

  }

  public function preencheTabelaUsuarios($id_empresa){
    $resposta = DB::table('tb_usuario')
    ->where('id_empresa_contratante', $id_empresa)
    ->where('usuario_ativo', 1)
    ->get();

    return $resposta;
  }

  public function preencheTabelaUsuariosDesativados($id_empresa){
    $resposta = DB::table('tb_usuario')
    ->where('id_empresa_contratante', $id_empresa)
    ->where('usuario_ativo', 0)
    ->get();

    return $resposta;
  }

  public function buscaNiveisAcesso(){
    $resposta = DB::table('tb_perfil_usuario')->where('id_perfil_usuario', '<>', '2')->get();

    return $resposta;

  }

  public function cadastraNovoUsuario($arrUsuario){

    $inserted_id = DB::table('tb_usuario')->insertGetId(
      ['nome_usuario'=> $arrUsuario['nome'],
       'email_usuario' => $arrUsuario['email'],
       'dial_code_tel_usuario' => 1,
       'numero_tel_usuario' => $arrUsuario['telefone'],
       'id_perfil_usuario' => $arrUsuario['nivel_acesso'],
       'id_empresa_contratante' => $arrUsuario['empresa'],
       'usuario_ativo' => 1,
       'usuario_validado' => 0
      ]);

    $enviar_email = new ClasseEmail();
    $token = new ClasseToken();
    $valor_token = $token->geraToken();
    $endereço_local = '189.126.111.90';
    $assunto = utf8_decode('Criação de senha de acesso');
    $corpo = utf8_decode("<p>".$arrUsuario['nome'].". Aqui está o link para a criar sua senha de acesso 
    <br><b> Link: </b><a href='http://".$endereço_local."/teste/nova-senha?token=".$valor_token."'>
    Clique Aqui</a></p>");

    DB::insert('INSERT INTO tb_token_senha (token, usuario_token) 
    VALUES (?,?)', array($valor_token, $inserted_id));

    $enviar_email->conectarEmail($arrUsuario['email'],$assunto,$corpo);
    
    $mensagem = "O usuário foi cadastrado com sucesso, 
    peça ao colaborador para fazer a ativação";
    echo json_encode(["flag" => true, "mensagem" => $mensagem ]);
  }

  public function buscaDadosUsuario($id){
    $resposta = DB::select('SELECT nome_usuario, email_usuario, numero_tel_usuario, id_perfil_usuario
    FROM tb_usuario WHERE id_usuario = ?',[$id]);

    return $resposta;
  }

  public function atualizaDadosUsuario($arrUsuario){
    $resposta = DB::update('UPDATE tb_usuario SET 
    nome_usuario = ?, email_usuario = ?, numero_tel_usuario = ?, id_perfil_usuario = ?
    WHERE id_usuario = ?', $arrUsuario);

    return $resposta;
  }
  public function reativaUsuario($id){

    $resposta = DB::update('UPDATE tb_usuario SET usuario_ativo = 1 WHERE id_usuario = ?', [$id]);
    
    return $resposta;
  }

  public function desativaUsuario($id){
    $permitir_desativar = $this->checaAdministradores($id);

    if($permitir_desativar == false){
      $resposta = false;
    }else{
      $resposta = DB::update('UPDATE tb_usuario SET usuario_ativo = 0 WHERE id_usuario = ?', [$id]);
    }
    return $resposta;
  }
}
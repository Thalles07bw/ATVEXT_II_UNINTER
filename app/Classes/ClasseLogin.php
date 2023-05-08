<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;

class ClasseLogin{
 
  function buscaUsuario($email){
    
    $user = DB::table('tb_usuario')->where('email_usuario', $email)->first();
    return $user;
  }

  function buscaEmpresa($id_empresa){
    $empresa = DB::table('tb_empresa_contratante')->where('id_empresa_contratante', $id_empresa)->first();

    return $empresa;
  }

  function buscaIdInstrutor($id_usuario){
    $teacher = DB::table('tb_instrutor')->where('id_usuario', $id_usuario)->first();

    return $teacher;
  }
  
}



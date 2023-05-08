<?php
namespace App\Classes;
use Illuminate\Support\Facades\DB;

class ClasseLoginCandidato{
 
    function buscaUsuario($email){
    
    $user = DB::table('tb_usuario_candidato')->where('email_usuario_candidato', $email)->first();
    return $user;
  }
  
}



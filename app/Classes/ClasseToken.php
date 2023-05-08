<?php
  namespace App\Classes;

  class ClasseToken{
    public function geraToken(){
      $bytes = random_bytes(9);
      return bin2hex($bytes);
    }
  }
?>
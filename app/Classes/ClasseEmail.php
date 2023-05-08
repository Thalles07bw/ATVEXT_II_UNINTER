<?php
namespace App\Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class ClasseEmail{
  public function conectarEmail($endereço, $assunto, $mensagem){
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try{
      //configurando charset e local

      $mail->charSet = "utf-8"; 
      $mail->setLanguage("br");
      
      //configuração do servidor

      //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'atendimento.basisrh@gmail.com';                     //SMTP username
      $mail->Password   = '23Set0950';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;
      
      //Recipients
      $mail->setFrom('atendimento.basisrh@gmail.com', 'Atendimento');
      $mail->addAddress($endereço);               //Name is optional

      //Conteudo que será enviado 
      $mail->isHTML(true);                          
      $mail->Subject = $assunto;

      $mail->msgHTML($mensagem);
      $mail->send();
      return true;
      
    }catch (Exception $e) {
      return false;
    }
  }
}

?>

<?php

  class Mailer {
    public $errors;

    public function __construct() {
      $mail = new PHPMailer();

      $mail->isSMTP();
      $mail->Host = 'smtp.sendgrid.net';
      $mail->SMTPAuth = true;
      $mail->Username = $_SERVER['SENDGRID_USERNAME'];
      $mail->Password = $_SERVER['SENDGRID_PASSWORD'];

      $mail->From = 'noreply@gaar.com.br';
      $mail->FromName = 'Site';

      $mail->isHtml(true);
      # $mail->SMTPDebug = 1; # Turn on to show debug messages

      $this->mail = $mail;
    }

    protected function send($subject, $message, $to = 'carlos.el.lopes@gmail.com') {
      $this->mail->AddAddress($to, 'Contato GAAR');
      $this->mail->Subject = $subject;
      $this->mail->Body = $message;

      return $this->mail->Send();
    }
  }

?>

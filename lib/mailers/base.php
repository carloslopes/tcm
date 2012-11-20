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

      $mail->From = 'carlos.el.lopes@gmail.com';
      $mail->FromName = 'Site';

      $mail->isHtml(true);

      $mail->SMTPDebug = 1; # Turn on only in development

      $this->mail = $mail;
    }

    protected function send($subject, $message, $to = 'carlos.el.lopes@gmail.com') {
      $this->mail->AddAddress($to, 'Site');
      $this->mail->Subject = $subject;
      $this->mail->Body = $message;

      return $this->mail->Send();
    }
  }

?>


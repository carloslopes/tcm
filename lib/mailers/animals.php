<?php

  class AnimalMailer extends Mailer {
    public function __construct() {
      parent::__construct();
    }

    public function adoption($animal, $donor, $adopter) {
      $message = "<h1>Olá $donor->name, um de seus animais foi solicitado para adoção!</h1>
        <p>O(a) $adopter->name pediu o $animal->name para adoção, entre em contato
        com essa pessoa para dar continuidade no processo.</p>
        <p>Atenciosamente, equipe GAAR</p>";

      return parent::send('Aviso GAAR', $message);
    }
  }

?>


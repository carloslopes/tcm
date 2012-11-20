<?php

  class Contact extends Mailer {
    public $name, $email, $subject, $message;

    private $SUBJECTS = array(
      'Quero adotar!',
      'Quero castrar!',
      'Quero divulgar!',
      'Quero ajudar!',
      'Elogios',
      'Dúvidas',
      'Críticas'
    );

    public function __construct($attrs = array()) {
      parent::__construct();
      $this->fill_attributes($attrs);
    }

    ### Validations
    ### ==================================
    public function valid() {
      $this->check_name();
      $this->check_email();
      $this->check_subject();
      $this->check_message();

      return empty($this->errors);
    }

    private function check_name() {
      if(empty($this->name) || $this->name === 'Informe seu nome...')
        $this->errors['name'] = 'Nome não pode ficar em branco';
    }

    private function check_email() {
      if(empty($this->email) || $this->email === 'Informe seu e-mail...')
        $this->errors['email'] = 'Email não pode ficar em branco';
      else if(!preg_match('/.+@.+\..+/', $this->email))
        $this->errors['email'] = 'Informe um email válido';
    }

    private function check_subject() {
      if(empty($this->subject) || !in_array($this->subject, $this->SUBJECTS))
        $this->errors['subject'] = 'Selecione um assunto';
    }

    private function check_message() {
      if(empty($this->message))
        $this->errors['message'] = 'Mensagem não pode ficar em branco';
    }

    ### Helpers Methods
    ### ==================================
    private function fill_attributes($attrs) {
      if(isset($attrs['name'])) { $this->name = $attrs['name']; }
      if(isset($attrs['email'])) { $this->email = $attrs['email']; }
      if(isset($attrs['subject'])) { $this->subject = $attrs['subject']; }
      if(isset($attrs['message'])) { $this->message = $attrs['message']; }
    }

    public function send() {
      if($this->valid()) {
        $message = "<h1>Mensagem enviada pelo site</h1>
          <p>Nome: $this->name</p>
          <p>E-mail: $this->email</p>
          <p>Mensagem: $this->message</p> ";

        return parent::send($this->subject, $message);
      }
      else
        return false;
    }

    public function subjects_select_tag() {
      echo '<select class="assunto" name="subject">';
      echo '<option>Selecione um assunto:</option>';

      foreach($this->SUBJECTS as $subject) {
        $selected = ($this->subject == $subject) ? 'selected' : '';
        echo "<option $selected>$subject</option>";
      }

      echo '</select>';
    }
  }

?>

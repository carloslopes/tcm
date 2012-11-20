<?php

  class Base {
    public $errors;
    protected $conn;

    public function __construct() {
      $this->conn = $GLOBALS['conn'];
    }
  }

?>

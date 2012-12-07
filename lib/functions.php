<?php

  # DB connection
  include 'database.php';
  $conn = db_connect();

  # Models
  include 'models/base.php';
  include 'models/animal.php';
  include 'models/vet.php';
  include 'models/clinic.php';
  include 'models/user.php';

  # Mailers
  include 'phpmailer/class.phpmailer.php';
  include 'phpmailer/class.smtp.php';
  include 'mailers/base.php';
  include 'mailers/contact.php';
  include 'mailers/animals.php';

  # Bcrypt
  include 'phpass-0.3/PasswordHash.php';
  $hasher = new PasswordHash(8, false);

  # Pics dir
  $pics_dir = '/var/uploads/';

  # Session
  session_start();

  $current_user;
  if(isset($_SESSION['user_id'])) {
    $klass = new User();
    $current_user = $klass->find($_SESSION['user_id']);
  }

  # Helpers
  function is_post() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }

  function not_found() {
    header(':', true, 404);
    include '../errors/404.html';
  }

  function sign_in($user) {
    global $current_user;

    $_SESSION['user_id'] = $user->id;
    $current_user = $user;
  }

  function sign_out() {
    session_unset();
    unset($GLOBALS['current_user']);
  }

  function signed_in() {
    global $current_user;
    return !empty($current_user);
  }

  function upload_pictures($animal, $files) {
    global $pics_dir;
    $errors = array();

    $upload_dir = $pics_dir . $animal->id;
    if(!file_exists($upload_dir)) mkdir($upload_dir);

    foreach($files as $file) {
      if($file['error'] === 4) continue; # Continue if no file was submitted
      $filename = $upload_dir . '/' . basename($file['name']);

      if($file['error'] !== 0 || !move_uploaded_file($file['tmp_name'], $filename))
        array_push($errors, $file['name']);
    }

    return $errors;
  }

  function delete_picture_folder($id) {
    global $pics_dir;
    $dir = $pics_dir . $id;
    array_map('unlink', glob($dir . '/*'));
    rmdir($dir);
  }

  function input_value($default, $variable) {
    if(empty($variable) || $variable === $default)
      echo "value=\"$default\" onfocus=\"if (this.value=='$default') this.value='';\" onblur=\"if (this.value=='') this.value='$default'\"";
    else
      echo "value='$variable'";
  }

  function input_error($message) {
    if(!empty($message))
      echo "<span class='erro'>$message</span>";
  }

  function show($string) {
    echo empty($string) ? '-' : $string;
  }

  function error_message($string) {
    global $message;
    $message = "<div style='border: 1px solid #900; background: #ffd9d9; padding: 8px; color: #900'>$string</div>";
  }

  function success_message($string) {
    global $message;
    $message = "<div style='border: 1px solid #004000; background: #ceffce; padding: 8px; color: #004000'>$string</div>";
  }

?>

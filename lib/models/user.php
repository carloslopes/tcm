<?php

  class User {
    public $id, $name, $email, $cpf, $address, $district, $city, $state, $phone, $admin;
    private $conn;

    private $encrypted_password;
    public $password, $password_confirmation;

    public function __construct($conn, $attrs = array()) {
      $this->conn = $conn;
      $this->fill_attributes($attrs);
    }

    ### Validations
    ### ==================================
    public function valid() {
      $this->check_name();
      $this->check_email();
      $this->check_cpf();
      $this->check_address();
      $this->check_district();
      $this->check_city();
      $this->check_state();
      $this->check_phone();
      $this->check_password();
      $this->check_password_confirmation();

      return empty($this->errors);
    }

    private function check_name() {
      if(empty($this->name))
        $this->errors['name'] = 'Nome não pode ficar em branco';
    }

    private function check_email() {
      if(empty($this->email))
        $this->errors['email'] = 'Email não pode ficar em branco';
      else if(!preg_match('/.+@.+\..+/', $this->email))
        $this->errors['email'] = 'Informe um email válido';
      else {
        $id   = addslashes($this->id);
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ? AND id NOT IN ('$id')");
        $stmt->bind_param('s', $this->email);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows() !== 0)
          $this->errors['email'] = 'Email já cadastrado';
      }
    }

    private function check_cpf() {
      if(empty($this->cpf))
        $this->errors['cpf'] = 'CPF não pode ficar em branco';
      else if(!preg_match('/.+\..+\..+-.+/', $this->cpf))
        $this->errors['cpf'] = 'Informe um CPF válido';
      else {
        $id   = addslashes($this->id);
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE cpf = ? AND id NOT IN ('$id')");
        $stmt->bind_param('s', $this->cpf);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows() !== 0)
          $this->errors['cpf'] = 'CPF já cadastrado';
      }
    }

    private function check_address() {
      if(empty($this->address))
        $this->errors['address'] = 'Endereço não pode ficar em branco';
    }

    private function check_district() {
      if(empty($this->district))
        $this->errors['district'] = 'Bairro não pode ficar em branco';
    }

    private function check_city() {
      if(empty($this->city))
        $this->errors['city'] = 'Cidade não pode ficar em branco';
    }

    private function check_state() {
      if(empty($this->state))
        $this->errors['state'] = 'Estado não pode ficar em branco';
    }

    private function check_phone() {
      if(empty($this->phone))
        $this->errors['phone'] = 'Telefone não pode ficar em branco';
    }

    private function check_password() {
      if(empty($this->id) && empty($this->password))
        $this->errors['password'] = 'Senha não pode ficar em branco';

      if(!empty($this->password) && strlen($this->password) < 8)
        $this->errors['password'] = 'Senha deve ter no mínimo 8 caracteres';
    }

    private function check_password_confirmation() {
      if($this->password_confirmation !== $this->password)
        $this->errors['password_confirmation'] = 'Confirmação de senha incorreta';
    }

    ### Db queries
    ### ==================================
    public function all() {
      $query = $this->conn->query('SELECT * FROM users');
      $users = array();

      while($row = $query->fetch_assoc()) {
        $user = new User($this->conn, $row);
        array_push($users, $user);
      }

      return $users;
    }

    public function save() {
      if($this->valid()) {
        if(empty($this->id)) {
          $stmt = $this->conn->prepare('INSERT INTO users (name, email, cpf, address, district, city, state, phone, encrypted_password, admin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
          $stmt->bind_param('sssssssssi', $this->name, $this->email, $this->cpf, $this->address, $this->district, $this->city, $this->state, $this->phone, $this->encrypted_password(), $this->admin);
          $stmt->execute();
          $this->id = mysqli_insert_id($this->conn);
        }
        else {
          if(empty($this->password)) {
            $stmt = $this->conn->prepare('UPDATE users SET name = ?, email = ?, cpf = ?, address = ?, district = ?, city = ?, state = ?, phone = ?, admin = ? WHERE id = ?');
            $stmt->bind_param('ssssssssii', $this->name, $this->email, $this->cpf, $this->address, $this->district, $this->city, $this->state, $this->phone, $this->admin, $this->id);
          }
          else {
            $stmt = $this->conn->prepare('UPDATE users SET name = ?, email = ?, cpf = ?, address = ?, district = ?, city = ?, state = ?, phone = ?, encrypted_password = ?, admin = ? WHERE id = ?');
            $stmt->bind_param('sssssssssii', $this->name, $this->email, $this->cpf, $this->address, $this->district, $this->city, $this->state, $this->phone, $this->encrypted_password(), $this->admin, $this->id);
          }

          $stmt->execute();
        }

        return $stmt;
      }
      else
        return false;
    }

    public function find($id) {
      $id = addslashes($id);
      $result = $this->conn->query("SELECT * FROM users WHERE id = $id");
      return new User($this->conn, $result->fetch_assoc());
    }

    public function find_by_email($email) {
      $email    = addslashes($email);
      $result = $this->conn->query("SELECT * FROM users WHERE email = '$email'");

      if(!$result || $result->num_rows === 0) return null;
      return new User($this->conn, $result->fetch_assoc());
    }

    public function update_attributes($attrs) {
      $this->fill_attributes($attrs);
      return $this->save();
    }

    public function destroy($id) {
      $id = addslashes($id);
      return $this->conn->query("DELETE FROM users WHERE id = $id");
    }

    public function authenticate($email, $password) {
      global $hasher;

      $user = $this->find_by_email($email);
      if(empty($user)) return null;

      if($hasher->CheckPassword($password, $user->encrypted_password))
        return $user;
      else
        return null;
    }

    ### Helpers Methods
    ### ==================================
    private function fill_attributes($attrs) {
      if(isset($attrs['id'])) { $this->id = $attrs['id']; }
      if(isset($attrs['name'])) { $this->name = $attrs['name']; }
      if(isset($attrs['email'])) { $this->email = $attrs['email']; }
      if(isset($attrs['cpf'])) { $this->cpf = $attrs['cpf']; }
      if(isset($attrs['address'])) { $this->address = $attrs['address']; }
      if(isset($attrs['district'])) { $this->district = $attrs['district']; }
      if(isset($attrs['city'])) { $this->city = $attrs['city']; }
      if(isset($attrs['state'])) { $this->state = $attrs['state']; }
      if(isset($attrs['phone'])) { $this->phone = $attrs['phone']; }
      if(isset($attrs['password'])) { $this->password = $attrs['password']; }
      if(isset($attrs['password_confirmation'])) { $this->password_confirmation = $attrs['password_confirmation']; }
      if(isset($attrs['encrypted_password'])) { $this->encrypted_password = $attrs['encrypted_password']; }
      if(isset($attrs['admin'])) { $this->admin = $attrs['admin']; }
    }

    public function admin_tag($checked) {
      if(empty($checked)) $checked = 0;
      echo '<input type="radio" name="admin" value="0" ' . ($checked == 0 ? 'checked' : '') . ' /> Não';
      echo '<input type="radio" name="admin" value="1" ' . ($checked == 1 ? 'checked' : '') . ' /> Sim';
    }

    private function encrypted_password() {
      return $this->secure_hash($this->password);
    }

    private function secure_hash($string) {
      global $hasher;
      return $hasher->HashPassword($string);
    }

    public function admin() {
      return $this->admin == 0 ? 'Não' : 'Sim';
    }
  }

?>

<?php

  class Clinic {
    public $id, $name, $address, $district, $city, $state, $phone, $email, $website;
    private $conn;
    private $vets = array();

    public function __construct($conn, $attrs = array()) {
      $this->conn = $conn;
      $this->fill_attributes($attrs);
    }

    ### Validations
    ### ==================================
    public function valid() {
      $this->check_name();
      $this->check_address();
      $this->check_district();
      $this->check_city();
      $this->check_state();
      $this->check_phone();
      $this->check_email();
      $this->check_website();

      return empty($this->errors);
    }

    private function check_name() {
      if(empty($this->name))
        $this->errors['name'] = 'Nome não pode ficar em branco';
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

    private function check_email() {
      if(!empty($this->email) && !preg_match('/.+@.+\..+/', $this->email))
        $this->errors['email'] = 'Informe um email válido';
    }

    private function check_website() {
      if(!empty($this->website) && !preg_match('/.+\..+/', $this->website))
        $this->errors['website'] = 'Informe um website válido';
    }

    ### Db queries
    ### ==================================
    public function all() {
      $result = $this->conn->query('SELECT * FROM clinics');
      $clinics = array();

      while($row = $result->fetch_assoc()) {
        $clinic = new Clinic($this->conn, $row);
        array_push($clinics, $clinic);
      }

      return $clinics;
    }

    public function save() {
      if($this->valid()) {
        if(empty($this->id)) {
          $stmt = $this->conn->prepare('INSERT INTO clinics (name, address, district, city, state, phone, email, website) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
          $stmt->bind_param('ssssssss', $this->name, $this->address, $this->district, $this->city, $this->state, $this->phone, $this->email, $this->website);
          $stmt->execute();
          $this->id = mysqli_insert_id($this->conn);
        }
        else {
          $stmt = $this->conn->prepare('UPDATE clinics SET name = ?, address = ?, district = ?, city = ?, state = ?, phone = ?, email = ?, website = ? WHERE id = ?');
          $stmt->bind_param('ssssssssi', $this->name, $this->address, $this->district, $this->city, $this->state, $this->phone, $this->email, $this->website, $this->id);
          $stmt->execute();
        }

        return $stmt;
      }
      else
        return false;
    }

    public function find($id) {
      $id = addslashes($id);
      $result = $this->conn->query("SELECT * FROM clinics WHERE id = $id");
      return new Clinic($this->conn, $result->fetch_assoc());
    }

    public function update_attributes($attrs) {
      $this->fill_attributes($attrs);
      return $this->save();
    }

    public function destroy($id) {
      $stmt = $this->conn->prepare("DELETE FROM clinics WHERE id = ?");
      $stmt->bind_param('i', $id);
      return $stmt->execute();
    }

    public function vets() {
      if(empty($this->vets)) {
        $query = $this->conn->query("SELECT * FROM vets WHERE clinic_id = $this->id");

        while($row = $query->fetch_assoc()) {
          $vet = new Vet($this->conn, $row);
          array_push($this->vets, $vet);
        }
      }

      return $this->vets;
    }

    ### Helpers Methods
    ### ==================================
    private function fill_attributes($attrs) {
      if(isset($attrs['id'])) { $this->id = $attrs['id']; }
      if(isset($attrs['name'])) { $this->name = $attrs['name']; }
      if(isset($attrs['address'])) { $this->address = $attrs['address']; }
      if(isset($attrs['district'])) { $this->district = $attrs['district']; }
      if(isset($attrs['city'])) { $this->city = $attrs['city']; }
      if(isset($attrs['state'])) { $this->state = $attrs['state']; }
      if(isset($attrs['phone'])) { $this->phone = $attrs['phone']; }
      if(isset($attrs['email'])) { $this->email = $attrs['email']; }
      if(isset($attrs['website'])) { $this->website = $attrs['website']; }
    }

    public function select_tag($selected) {
      $clinics = $this->all();

      echo '<select name="clinic_id">';

      foreach($clinics as $clinic) {
        if($clinic->id === $selected)
          echo "<option value='$clinic->id' selected='selected'>$clinic->name</option>";
        else
          echo "<option value='$clinic->id'>$clinic->name</option>";
      }

      echo '</select>';
    }
  }

?>

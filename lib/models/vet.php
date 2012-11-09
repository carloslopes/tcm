<?php

  class Vet {
    public $id, $crmv, $name, $email, $phone, $clinic_id;
    private $conn, $clinic;

    public function __construct($conn, $attrs = array()) {
      $this->conn = $conn;
      $this->fill_attributes($attrs);
    }

    ### Validations
    ### ==================================
    public function valid() {
      $this->check_crmv();
      $this->check_name();
      $this->check_email();
      $this->check_phone();

      return empty($this->errors);
    }

    private function check_crmv() {
      if(empty($this->crmv))
        $this->errors['crmv'] = 'CRMV não pode ficar em branco';
      else {
        $id   = addslashes($this->id);
        $stmt = $this->conn->prepare("SELECT id FROM vets WHERE crmv = ? AND id NOT IN ('$id')");
        $stmt->bind_param('s', $this->crmv);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows() !== 0)
          $this->errors['crmv'] = 'CRMV já cadastrado';
      }
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
    }

    private function check_phone() {
      if(empty($this->phone))
        $this->errors['phone'] = 'Telefone não pode ficar em branco';
    }

    ### Db queries
    ### ==================================
    public function all() {
      $result = $this->conn->query('SELECT * FROM vets');
      $vets = array();

      while($row = $result->fetch_assoc()) {
        $vet = new Vet($this->conn, $row);
        array_push($vets, $vet);
      }

      return $vets;
    }

    public function save() {
      if($this->valid()) {
        if(empty($this->id)) {
          $stmt = $this->conn->prepare('INSERT INTO vets (crmv, name, email, phone, clinic_id) VALUES (?, ?, ?, ?, ?)');
          $stmt->bind_param('ssssi', $this->crmv, $this->name, $this->email, $this->phone, $this->clinic_id);
          $stmt->execute();
          $this->id = mysqli_insert_id($this->conn);
        }
        else {
          $stmt = $this->conn->prepare('UPDATE vets SET crmv = ?, name = ?, email = ?, phone = ?, clinic_id = ? WHERE id = ?');
          $stmt->bind_param('ssssii', $this->crmv, $this->name, $this->email, $this->phone, $this->clinic_id, $this->id);
          $stmt->execute();
        }

        return $stmt;
      }
      else
        return false;
    }

    public function find($id) {
      $id = addslashes($id);
      $result = $this->conn->query("SELECT * FROM vets where id = $id");
      return new Vet($this->conn, $result->fetch_assoc());
    }

    public function update_attributes($attrs) {
      $this->fill_attributes($attrs);
      return $this->save();
    }

    public function destroy($id) {
      $stmt = $this->conn->prepare("DELETE FROM vets WHERE id = ?");
      $stmt->bind_param('i', $id);
      return $stmt->execute();
    }

    ### Helpers Methods
    ### ==================================
    private function fill_attributes($attrs) {
      if(isset($attrs['id'])) { $this->id = $attrs['id']; }
      if(isset($attrs['crmv'])) { $this->crmv = $attrs['crmv']; }
      if(isset($attrs['name'])) { $this->name = $attrs['name']; }
      if(isset($attrs['email'])) { $this->email = $attrs['email']; }
      if(isset($attrs['phone'])) { $this->phone = $attrs['phone']; }
      if(isset($attrs['clinic_id'])) { $this->clinic_id = $attrs['clinic_id']; }
    }

    public function clinic() {
      if(empty($this->clinic_id)) return new Clinic($this->conn);

      if(empty($this->clinic)) {
        $klass = new Clinic($this->conn);
        $this->clinic = $klass->find($this->clinic_id);
      }

      return $this->clinic;
    }
  }

?>

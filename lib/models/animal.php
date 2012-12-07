<?php

  class Animal extends Base {
    public $id, $name, $specie, $breed, $color, $age, $description, $history, $donor_id;
    private $donor, $donation_date, $adopter_id, $adopter, $adoption_date, $status;

    private $COLORS = array(
      0 => 'Branco',
      1 => 'Preto',
      2 => 'Marrom',
      3 => 'Pardo'
    );

    private $SPECIES = array(
      0 => 'Cachorro',
      1 => 'Gato'
    );

    private $BREEDS = array(
      0 => 'Vira-lata',
      1 => 'Pitbull',
      2 => 'Siames',
      3 => 'Bulldog',
      4 => 'Egípcio'
    );

    private $STATUS = array(
      0 => 'Para adoção',
      1 => 'Em análise',
      2 => 'Adotado'
    );

    public function __construct($attrs = array()) {
      parent::__construct();
      $this->status = 0;
      $this->fill_attributes($attrs);
    }

    ### Validations
    ### ==================================
    public function valid() {
      $this->check_name();
      $this->check_specie();
      $this->check_breed();
      $this->check_color();
      $this->check_age();
      $this->check_description();
      $this->check_history();
      $this->check_status();

      return empty($this->errors);
    }

    private function check_name() {
      if(empty($this->name) || $this->name === 'Informe o nome do animal...')
        $this->errors['name'] = 'Nome não pode ficar em branco';
    }

    private function check_specie() {
      if(!isset($this->specie))
        $this->errors['specie'] = 'A espécie deve ser informada';
      else if(!array_key_exists($this->specie, $this->SPECIES))
        $this->errors['specie'] = 'Informe uma espécie válida';
    }

    private function check_breed() {
      if(!isset($this->breed))
        $this->errors['breed'] = 'Raça não pode ficar em branco';
      else if(!array_key_exists($this->breed, $this->BREEDS))
        $this->errors['breed'] = 'Informe uma raça válida';
    }

    private function check_color() {
      if(!isset($this->color))
        $this->errors['color'] = 'A cor deve ser informada';
      else if(!array_key_exists($this->color, $this->COLORS))
        $this->errors['color'] = 'Informe uma cor válida';
    }

    private function check_age() {
      if($this->age === 'Informe a idade aproximada do animal...')
        $this->age = null;
      else if(!empty($this->age) && !is_numeric($this->age))
        $this->errors['age'] = 'Idade aproximada deve ser um número';
    }

    private function check_description() {
      if(empty($this->description))
        $this->errors['description'] = 'Descrição do comportamento não pode ficar em branco';
    }

    private function check_history() {
      if(empty($this->history))
        $this->errors['history'] = 'História do animal não pode ficar em branco';
    }

    private function check_status() {
      if(!isset($this->status))
        $this->errors['status'] = 'O status deve ser informado';
      else if(!array_key_exists($this->status, $this->STATUS))
        $this->errors['status'] = 'Informe um status válido';
    }

    ### Db queries
    ### ==================================
    public function all($where = null) {
      if(!empty($where)) $where = 'WHERE ' . $where;
      $result = $this->conn->query("SELECT * FROM animals $where");
      $animals = array();

      while($row = $result->fetch_assoc()) {
        $animal = new Animal($row);
        array_push($animals, $animal);
      }

      return $animals;
    }

    public function save() {
      if($this->valid()) {
        if(empty($this->id)) {
          $stmt = $this->conn->prepare('INSERT INTO animals (name, specie, breed, color, age, description, history, donor_id, donation_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())');
          $stmt->bind_param('sisiissi', $this->name, $this->specie, $this->breed, $this->color, $this->age, $this->description, $this->history, $this->donor_id);
          $stmt->execute();
          $this->id = mysqli_insert_id($this->conn);
        }
        else {
          $stmt = $this->conn->prepare('UPDATE animals SET name = ?, specie = ?, breed = ?, color = ?, age = ?, description = ?, history = ?, status = ? WHERE id = ?');
          $stmt->bind_param('sisiissii', $this->name, $this->specie, $this->breed, $this->color, $this->age, $this->description, $this->history, $this->status, $this->id);
          $stmt->execute();
        }

        return $stmt;
      }
      else
        return false;
    }

    public function find($id) {
      $id = addslashes($id);
      $query = $this->conn->query("SELECT * FROM animals WHERE id = $id");
      $row   = $query->fetch_assoc();
      return new Animal($row);
    }

    public function destroy($id) {
      global $pics_dir;

      $stmt = $this->conn->prepare("DELETE FROM animals WHERE id = ?");
      $stmt->bind_param('i', $id);

      return $stmt->execute() && delete_picture_folder($id);
    }

    public function update_attributes($attrs) {
      $this->fill_attributes($attrs);
      return $this->save($this->conn);
    }

    public function last($offset, $status = '0,1,2') {
      $status = addslashes($status);
      $query = $this->conn->query("SELECT * FROM animals WHERE status IN ($status) ORDER BY id DESC LIMIT $offset");
      $animals = array();

      while($row = $query->fetch_assoc()) {
        $animal = new Animal($row);
        array_push($animals, $animal);
      }

      return $animals;
    }

    ### Helpers Methods
    ### ==================================
    private function fill_attributes($attrs) {
      if(isset($attrs['id'])) { $this->id = $attrs['id']; }
      if(isset($attrs['name'])) { $this->name = $attrs['name']; }
      if(isset($attrs['specie'])) { $this->specie = $attrs['specie']; }
      if(isset($attrs['breed'])) { $this->breed = $attrs['breed']; }
      if(isset($attrs['color'])) { $this->color = $attrs['color']; }
      if(isset($attrs['age'])) { $this->age = $attrs['age']; }
      if(isset($attrs['description'])) { $this->description = $attrs['description']; }
      if(isset($attrs['history'])) { $this->history = $attrs['history']; }
      if(isset($attrs['donor_id'])) { $this->donor_id = $attrs['donor_id']; }
      if(isset($attrs['donation_date'])) { $this->donation_date = $attrs['donation_date']; }
      if(isset($attrs['adopter_id'])) { $this->adopter_id = $attrs['adopter_id']; }
      if(isset($attrs['adoption_date'])) { $this->adoption_date = $attrs['adoption_date']; }
      if(isset($attrs['status'])) { $this->status = $attrs['status']; }
    }

    public function specie() {
      return $this->SPECIES[$this->specie];
    }

    public function color() {
      return $this->COLORS[$this->color];
    }

    public function breed() {
      return $this->BREEDS[$this->breed];
    }

    public function status() {
      return $this->STATUS[$this->status];
    }

    public function pictures() {
      global $pics_dir;
      $files = array();
      $dir = $pics_dir . $this->id . '/';

      if(file_exists($dir) && $handle = opendir($pics_dir . $this->id)) {
        while(false !== ($entry = readdir($handle))) {
          if($entry !== '.' && $entry !== '..')
            array_push($files, "/imagens/animals/$this->id/$entry");
        }
      }

      return $files;
    }

    public function species_radio_tag() {
      $checked = empty($this->specie) ? 0 : $this->specie;

      foreach($this->SPECIES as $key => $value) {
        $checked_str = ($key == $checked) ? 'checked="checked"' : '';
        echo "<input type='radio' name='specie' $checked_str value='$key' />$value";
      }
    }

    public function status_radio_tag() {
      $checked = empty($this->status) ? 0 : $this->status;

      foreach($this->STATUS as $key => $value) {
        $checked_str = ($key == $checked) ? 'checked="checked"' : '';
        echo "<input type='radio' name='status' $checked_str value='$key' />$value";
      }
    }

    public function colors_select_tag() {
      echo '<select name="color">';
      echo '<option value="%">Informe a cor do animal...</option>';

      foreach($this->COLORS as $key => $value) {
        $selected_str = (isset($this->color) && $key == $this->color) ? 'selected' : '';
        echo "<option value='$key' $selected_str>$value</option>";
      }

      echo '</select>';
    }

    public function breeds_select_tag() {
      echo '<select name="breed">';
      echo '<option value="%">Informe a raça do animal...</option>';

      foreach($this->BREEDS as $key => $value) {
        $selected_str = (isset($this->breed) && $key == $this->breed) ? 'selected' : '';
        echo "<option value='$key' $selected_str>$value</option>";
      }

      echo '</select>';
    }

    public function donation_date() {
      $date = new DateTime($this->donation_date);
      return date_format($date, 'd/m/Y');
    }

    public function adoption_date() {
      if(empty($this->adoption_date)) return null;
      $date = new DateTime($this->adoption_date);
      return date_format($date, 'd/m/Y');
    }

    public function show_path() {
      echo "/animals/show.php?id=$this->id";
    }

    public function edit_path() {
      echo "/animals/edit.php?id=$this->id";
    }

    public function adopt_path() {
      echo "/animals/adopt.php?id=$this->id";
    }

    public function donor() {
      if(empty($this->donor)) {
        $id = addslashes($this->donor_id);
        $result = $this->conn->query("SELECT * FROM users WHERE id = $id");
        $this->donor = new User($result->fetch_assoc());
      }

      return $this->donor;
    }

    public function adoption($user_id) {
      $stmt = $this->conn->prepare('UPDATE animals SET adopter_id = ?, adoption_date = NOW(), status = 1 WHERE id = ?');
      $stmt->bind_param('ii', $user_id, $this->id);
      $stmt->execute();
    }

    public function adopter() {
      if(empty($this->adopter) && !empty($this->adopter_id)) {
        $id = addslashes($this->adopter_id);
        $result = $this->conn->query("SELECT * FROM users WHERE id = $id");
        $this->adopter = new User($result->fetch_assoc());
      }

      return $this->adopter;
    }

    public function adopted() {
      return $this->status != 0;
    }
  }

?>

<?php

  class Animal extends Base {
    public $id, $name, $specie, $breed, $color, $age, $description, $history, $donor_id;
    private $donation_date;

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

    public function __construct($attrs = array()) {
      parent::__construct();
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

    public function search($specie, $breed, $color, $age, $description) {
      switch($age) {
        case '%':
          $age_query = '';
          break;

        case '0':
          $age_query = 'AND age BETWEEN 1 AND 3';
          break;

        case '1':
          $age_query = 'AND age BETWEEN 4 AND 6';
          break;

        case '2':
          $age_query = 'AND age > 6';
          break;
      }

      $result = $this->conn->query("SELECT * FROM animals WHERE specie = '$specie' AND breed LIKE '$breed' AND color LIKE '$color' $age AND description LIKE '%$description%'");
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
          $stmt = $this->conn->prepare('UPDATE animals SET name = ?, specie = ?, breed = ?, color = ?, age = ?, description = ?, history = ? WHERE id = ?');
          $stmt->bind_param('sisiissi', $this->name, $this->specie, $this->breed, $this->color, $this->age, $this->description, $this->history, $this->id);
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

    public function show_path() {
      echo "/animal.php?id=$this->id";
    }

    public function edit_path() {
      echo "/editar-animal.php?id=$this->id";
    }
  }

?>

<?php

  class Animal {
    public $id, $name, $specie, $race, $color, $age, $description, $history;
    private $conn;

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

    public function __construct($conn, $attrs = array()) {
      $this->conn = $conn;
      $this->fill_attributes($attrs);
    }

    ### Validations
    ### ==================================
    public function valid() {
      $this->check_name();
      $this->check_specie();
      $this->check_race();
      $this->check_color();
      $this->check_age();
      $this->check_description();
      $this->check_history();

      return empty($this->errors);
    }

    private function check_name() {
      if(empty($this->name))
        $this->errors['name'] = 'Nome não pode ficar em branco';
    }

    private function check_specie() {
      if(!isset($this->specie))
        $this->errors['specie'] = 'A espécie deve ser informada';
      else if(!array_key_exists($this->specie, $this->SPECIES))
        $this->errors['specie'] = 'Informe uma espécie válida';
    }

    private function check_race() {
      if(empty($this->race))
        $this->errors['race'] = 'Raça não pode ficar em branco';
    }

    private function check_color() {
      if(!isset($this->color))
        $this->errors['color'] = 'A cor deve ser informada';
      else if(!array_key_exists($this->color, $this->COLORS))
        $this->errors['color'] = 'Informe uma cor válida';
    }

    private function check_age() {
      if(!empty($this->age) && !is_numeric($this->age))
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
    public function all() {
      $result = $this->conn->query('SELECT * FROM animals');
      $animals = array();

      while($row = $result->fetch_assoc()) {
        $animal = new Animal($this->conn, $row);
        array_push($animals, $animal);
      }

      return $animals;
    }

    public function save() {
      if($this->valid()) {
        if(!empty($this->id)) {
          $stmt = $this->conn->prepare('UPDATE animals SET name = ?, specie = ?, race = ?, color = ?, age = ?, description = ?, history = ? WHERE id = ?');
          $stmt->bind_param('sisiissi', $this->name, $this->specie, $this->race, $this->color, $this->age, $this->description, $this->history, $this->id);
          $stmt->execute();
        }
        else {
          $stmt = $this->conn->prepare('INSERT INTO animals (name, specie, race, color, age, description, history) VALUES (?, ?, ?, ?, ?, ?, ?)');
          $stmt->bind_param('sisiiss', $this->name, $this->specie, $this->race, $this->color, $this->age, $this->description, $this->history);

          $stmt->execute();
          $this->id = mysqli_insert_id($this->conn);
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
      return new Animal($this->conn, $row);
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
      if(isset($attrs['race'])) { $this->race = $attrs['race']; }
      if(isset($attrs['color'])) { $this->color = $attrs['color']; }
      if(isset($attrs['age'])) { $this->age = $attrs['age']; }
      if(isset($attrs['description'])) { $this->description = $attrs['description']; }
      if(isset($attrs['history'])) { $this->history = $attrs['history']; }
    }

    public function specie() {
      return $this->SPECIES[$this->specie];
    }

    public function color() {
      return $this->COLORS[$this->color];
    }

    public function pictures() {
      global $pics_dir;
      $files = array();
      $dir = $pics_dir . $this->id . '/';

      if(file_exists($dir) && $handle = opendir($pics_dir . $this->id)) {
        while(false !== ($entry = readdir($handle))) {
          if($entry !== '.' && $entry !== '..')
            array_push($files, $this->id . '/' . $entry);
        }
      }

      return $files;
    }
  }

?>

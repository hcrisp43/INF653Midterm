<?php 
	class Author {
		private $conn;
		private $table = 'authors';

		// Properties
		public $id;
		public $name;


		// Constructor
		public function __construct($db) {
      $this->conn = $db;
    }

    // Get Authors
    public function read(){
    	$query = 'SELECT id, author FROM ' . $this->table;

    	$stmt = $this->conn->prepare($query);
    	$stmt->execute();

    	return $stmt;
    }

    public function read_single(){
    	$query = 'SELECT id, author FROM ' . $this->table . ' WHERE id = ?';

    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(1, $this->id);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	$this->name = $row['author'] ?? NULL;
    		  
    }

    public function create(){
    	$query = 'INSERT INTO ' . $this->table . 'SET author = ?';

    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(1, $this->name);

    	if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    public function update() {
      $query = 'UPDATE ' . $this->table . 'SET author = :author WHERE id = :id';

      $stmt = $this->conn->prepare($query);

      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->id = htmlspecialchars(strip_tags($this->id));

      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':id', $this->id);

      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);
      return false;
    }


    public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind Data
    $stmt-> bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
  }

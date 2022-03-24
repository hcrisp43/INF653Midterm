<?php 
	class Quote {
		private $conn;
		private $table = 'quotes';

		// Properties
		public $id;
		public $quote;
    public $authorId;
    public $categoryId;

		// Constructor
		public function __construct($db) {
      $this->conn = $db;
    }

    // Get Categories
    public function read(){
    	$query = 'SELECT * FROM ' . $this->table;

    	$stmt = $this->conn->prepare($query);
    	$stmt->execute();

    	return $stmt;
    }

    public function read_single(){
    	$query = 'SELECT id, quote, authorId, categoryId FROM ' . $this->table . ' WHERE id = ?';

    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(1, $this->id);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	$this->name = $row['category'] ?? NULL;
    		  
    }

    public function create(){
    	$query = 'INSERT INTO ' . $this->table . 'SET quote = :qt, authorId = :ai, categoryId = :ci';

    	$stmt = $this->conn->prepare($query);
    	$stmt->bindParam(':qt', $this->quote);
      $stmt->bindParam(':ai', $this->authorId);
      $stmt->bindParam(':ci', $this->categoryId);

    	if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    public function update() {
      $query = 'UPDATE ' . $this->table . 'SET quote = :qt, authorId = :ai, categoryId = :ci WHERE id = :id';

      $stmt = $this->conn->prepare($query);

      $this->id = htmlspecialchars(strip_tags($this->id));
      $this->quote = htmlspecialchars(strip_tags($this->quote));
      $this->authorId = htmlspecialchars(strip_tags($this->authorId));
      $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

     
      $stmt->bindParam(':id', $this->id);
      $stmt->bindParam(':qt', $this->quote);
      $stmt->bindParam(':ai', $this->authorId);
      $stmt->bindParam(':ci', $this->categoryId);

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

	
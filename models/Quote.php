<?php

    class Quote {
        //DB stuff
        private $conn;
        private $table = 'quotes';

        //Quote Properties
        public $id;
        public $quote;
        public $category_id;
        public $author_id;

        //Constructor with DB (runs auto when instantiate obj from a class)
        public function __construct($db) {
            $this->conn = $db;
        }

        //Get Quotes
        public function read() {
            //Create query (using aliases)
            $query = 'SELECT
                id,
                quote,
                category_id,
                author_id
            FROM
                ' . $this->table . '
            ORDER BY 
                id DESC';
            
                // Prepare statement
                $stmt = $this->conn->prepare($query);

                //Execute query
                $stmt->execute();

                return $stmt;
        }

        // Get Single Quote
        public function read_single() {
          //Create query (using aliases)
          $query = 'SELECT
                      id,
                      quote,
                      category_id,
                      author_id
                    FROM
                      ' . $this->table . '
                    WHERE
                      id = ?
                    ORDER BY 
                      id DESC';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID (positional)
          $stmt->bindParam(1, $this->id);
              
          //Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          if($row) {
          // Set properties to what is returned
          $this->id = $row['id'];
          $this->quote = $row['quote'];
          $this->author_id = $row['author_id'];
          $this->category_id = $row['category_id'];
        }
    }


         // Create Quote
     public function create(){
        // Create query
        $query = 'INSERT INTO ' . $this->table . '
              (quote, author_id, category_id)
              VALUES
              (:quote, :author_id, :category_id)';
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        
        // Bind data
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);

        // Execute query
        if($stmt->execute()){
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
     }
    
    // Update Quote
    public function Update(){
        // Create query
        $query = 'UPDATE ' . $this->table . '
            SET 
                quote = :quote,
                author_id = :author_id,
                category_id = :category_id
            WHERE 
                id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);
        // Execute query
        if($stmt->execute()){
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
     }

     // Delete Quote
     public function delete(){
        // Create query
        $query = 'DELETE FROM ' . $this->table . '  WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind date
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if($stmt->execute()){
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
     }
    }
        

<?php

    class Author {
        //Db Stuff
        private $conn;
        private $table = 'authors';

        //Post Properties
        public $id;
        public $author;

        //Constructor with DB (runs auto when instantiate obj from a class)
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get categories
        public function read() {
            // Create query
            $query = 'SELECT
                id,
                author
                
            FROM
                ' . $this->table . '
            ORDER BY 
                id DESC';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }


        // Get single quote
        public function read_single() {
            // Create query
            $query = 'SELECT
                id,
                author   
            FROM
                ' . $this->table . '
            WHERE
                id = ?
            LIMIT 1 OFFSET 0';
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID (positional)
            $stmt->bindParam(1, $this->id);

            // Execute query
            $stmt->execute();
        // Check if row was found
    if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties to what is returned
            $this->author = $row['author'];
                // Return true
                return true;
            } else {
                // Return false
                return false;
            }
        }

        public function create(){
            // Create query
            $query = 'INSERT INTO ' . $this->table . '
                  SET
                    author = :author';

            $query = 'INSERT INTO ' . $this->table . ' 
                    (author) 
                VALUES 
                    (:author)';

    
                // Prepare statement
                $stmt = $this->conn->prepare($query);
    
                //Clean data
                $this->author = htmlspecialchars(strip_tags($this->author));
            
            // Bind data
            $stmt->bindParam(':author', $this->author);
    
            // Execute query
            if($stmt->execute()){
                return true;
            }
    
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
    
            return false;
         }

             // Update Author
    public function Update(){
        // Create query
        $query = 'UPDATE ' . $this->table . '
            SET 
                author = :author
            WHERE 
                id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);
        // Execute query
        if($stmt->execute()){
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
     }

     // Delete Author
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
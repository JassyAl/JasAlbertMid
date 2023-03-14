<?php

    class Category {
        //Db Stuff
        private $conn;
        private $table = 'categories';

        //Post Properties
        public $id;
        public $category;
        // public $created_at;

        //Constructor with DB (runs auto when instantiate obj from a class)
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get categories
        public function read() {
            // Create query
            $query = 'SELECT
                id,
                category
                
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
            category
            
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

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
        // Set properties to what is returned
        $this->category = $row['category'];
    } 
}

    

        public function create(){
            // Create query
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    category = :category';

            $query = 'INSERT INTO ' . $this->table . ' 
                    (category) 
                VALUES 
                    (:category)';


                // Prepare statement
                $stmt = $this->conn->prepare($query);

                //Clean data
                $this->category = htmlspecialchars(strip_tags($this->category));
            
            // Bind data
            $stmt->bindParam(':category', $this->category);

            // Execute query
            if($stmt->execute()){
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

            // Update category
    public function Update(){
        // Create query
        $query = 'UPDATE ' . $this->table . '
            SET 
                category = :category
            WHERE 
                id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->category = htmlspecialchars(strip_tags($this->category));
            $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $this->id);
        // Execute query
        if($stmt->execute()){
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Delete category
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
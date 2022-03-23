<?php
    class Category {
        // db properties
        private $conn;
        private $table = 'categories';

        //category properties
        public $id;
        public $category;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }
        
        // create category
        public function create() {
            // create query
            $query = 'INSERT INTO ' . 
            $this->table . '
            SET
                category = :category';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            // clean data
            $this->category = htmlspecialchars(strip_tags($this->category));

            // bind data
            $stmt->bindParam(':category', $this->category);

            // execute query
            if($stmt->execute()){
                return true;
            }

            // print error if issue occurs
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
        // delete category
        public function delete() {
            //create query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            // clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // bind data
            $stmt->bindParam(':id', $this->id);

            // execute query
            if($stmt->execute()){
                return true;
            }

            // print error if issue occurs
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        // update category
        public function update() {
            // create query
            $query = 'UPDATE ' . 
            $this->table . '
            SET
                id = :id,
                category = :category
            WHERE 
                id = :id';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            // clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->category = htmlspecialchars(strip_tags($this->category));

            // bind data
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':category', $this->category);
            
            // execute query
            if($stmt->execute()){
                return true;
            }

            // print error if issue occurs
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        // read categories
        public function read() {
            // Create query
            $query = 'SELECT 
                c.id,
                c.category
            FROM
                ' . $this->table . ' c';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();
            return $stmt;
        }

        // read single category
        public function read_single() {
            // Create query
            $query = 'SELECT 
                c.id,
                c.category
            FROM
                ' . $this->table . ' c
            WHERE 
                c.id = ?
            LIMIT 0,1';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //set properties
            $this->id = $row['id'];
            $this->author = $row['author'];
        }

    }
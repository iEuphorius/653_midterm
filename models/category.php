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
    }
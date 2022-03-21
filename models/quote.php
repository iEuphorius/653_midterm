<?php
    class Quote {
        // db properties
        private $conn;
        private $table = 'quotes';

        //quote properties
        public $id;
        public $quote;
        public $authorId;
        public $categoryId;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // create quote
        public function create() {
            // create query
            $query = 'INSERT INTO ' . 
            $this->table . '
            SET
                quote = :quote,
                authorId = :authorId,
                categoryId = :categoryId';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            // clean data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->authorId = htmlspecialchars(strip_tags($this->authorId));
            $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

            // bind data
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':authorId', $this->authorId);
            $stmt->bindParam(':categoryId', $this->categoryId);

            // execute query
            if($stmt->execute()){
                return true;
            }

            // print error if issue occurs
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
        
        // delete quote
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
    }
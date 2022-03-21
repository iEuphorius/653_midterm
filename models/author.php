<?php
    class Author {
        // db properties
        private $conn;
        private $table = 'authors';

        //author properties
        public $id;
        public $author;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // create author
        public function create() {
            // create query
            $query = 'INSERT INTO ' . 
            $this->table . '
            SET
                author = :author';

            // prepare statement
            $stmt = $this->conn->prepare($query);

            // clean data
            $this->author = htmlspecialchars(strip_tags($this->author));

            // bind data
            $stmt->bindParam(':author', $this->author);

            // execute query
            if($stmt->execute()){
                return true;
            }

            // print error if issue occurs
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
        // delete author
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
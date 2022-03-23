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

        //Get quotes
        public function read() {
            // Create query
            $query = 'SELECT 
                q.id,
                q.quote,
                q.categoryId,                
                q.authorId
            FROM
                ' . $this->table . ' q';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();
            return $stmt;
        }

        // Get Single quotes
        public function read_single() {
            // Create query
            $query = 'SELECT 
                q.id,
                q.quote,
                q.categoryId,                
                q.authorId
            FROM
                ' . $this->table . ' q 
            WHERE 
                q.id = ?
            LIMIT 0,1';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //set properties
            $this->id = $row['id'];
            $this->quote = $row['quote'];
            $this->categoryId = $row['categoryId'];
            $this->authorId = $row['authorId'];
        }

    }
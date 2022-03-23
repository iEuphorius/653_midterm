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

        // read author
        public function read() {
            // Create query
            $query = 'SELECT 
                a.id,
                a.author
            FROM
                ' . $this->table . ' a';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();
            return $stmt;
        }

        // read single author
        public function read_single() {
            // Create query
            $query = 'SELECT 
                a.id,
                a.author
            FROM
                ' . $this->table . ' a
            WHERE 
                a.id = ?
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
            $this->author = $row['authorId'];
        }
    }
<?php
    class Service {
        private $conn;
        private $table = 'service';

        public $name;
        public $price;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function view() {
            $query = 'SELECT * FROM ' . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function search() {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE name = ?';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->name);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->name = $row['name'];
            $this->price = $row['price'];
        }

        public function insert() {
            $query = 'INSERT INTO ' . $this->table . ' SET name = :name, price = :price';
            $stmt = $this->conn->prepare($query);
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':price', $this->price);
            if ($stmt->execute()) {
                if ($stmt->rowCount()) {
                    return true;
                }
                return false;
            } else {
                printf("Error: %s.\n", $stmt->error);
                return false;
            }
        }

        public function update() {
            $query = 'UPDATE ' . $this->table . ' SET price = :price WHERE name = :name';
            $stmt = $this->conn->prepare($query);
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':price', $this->price);
            if ($stmt->execute()) {
                if ($stmt->rowCount()) {
                    return true;
                }
                return false;
            } else {
                printf("Error: %s.\n", $stmt->error);
                return false;
            }
        }

        public function delete() {
            $query = 'DELETE FROM ' . $this->table . ' WHERE name = :name';
            $stmt = $this->conn->prepare($query);
            $this->name = htmlspecialchars(strip_tags($this->name));
            $stmt->bindParam(':name', $this->name);
            if ($stmt->execute()) {
                if ($stmt->rowCount()) {
                    return true;
                }
                return false;
            } else {
                printf("Error: %s.\n", $stmt->error);
                return false;
            }
        }
    }
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
            return $stmt;
        }

        public function insert() {
            $query = 'INSERT INTO ' . $this->table . ' SET name = :name, price = :price';
            $stmt = $this->conn->prepare($query);
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':price', $this->price);
            try {
				$stmt->execute();
				if ($stmt->rowCount()) {
					return true;
				}
				return false;
			} catch (PDOException $e) {
				echo ($e->getMessage());
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
            try {
				$stmt->execute();
				if ($stmt->rowCount()) {
					return true;
				}
				return false;
			} catch (PDOException $e) {
				echo ($e->getMessage());
				return false;
			}
        }

        public function delete() {
            $query = 'DELETE FROM ' . $this->table . ' WHERE name = :name';
            $stmt = $this->conn->prepare($query);
            $this->name = htmlspecialchars(strip_tags($this->name));
            $stmt->bindParam(':name', $this->name);
            try {
				$stmt->execute();
				if ($stmt->rowCount()) {
					return true;
				}
				return false;
			} catch (PDOException $e) {
				echo ($e->getMessage());
				return false;
			}
        }
    }
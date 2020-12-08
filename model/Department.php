<?php
    class Department
    {
        private $conn;
        private $table = 'department';

        public $dnumber;
        public $type;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function view()
        {
            $query = 'SELECT *
                FROM ' . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function search()
        {
            $query = 'SELECT *
                FROM ' . $this->table . '
                WHERE dnumber = ?';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->dnumber);
            $stmt->execute();
            return $stmt;
        }

        public function insert()
        {
            $query = 'INSERT INTO ' . $this->table . '
                        SET dnumber = :dnumber, type = :type';
            $stmt = $this->conn->prepare($query);
            $this->dnumber = htmlspecialchars(strip_tags($this->dnumber));
            $this->type = htmlspecialchars(strip_tags($this->type));
            $stmt->bindParam(':dnumber', $this->dnumber);
            $stmt->bindParam(':type', $this->type);
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

        public function update()
        {
            $query = 'UPDATE ' . $this->table . '
                SET type = :type
                WHERE dnumber = :dnumber';
            $stmt = $this->conn->prepare($query);
            $this->dnumber = htmlspecialchars(strip_tags($this->dnumber));
            $this->type = htmlspecialchars(strip_tags($this->type));
            $stmt->bindParam(':dnumber', $this->dnumber);
            $stmt->bindParam(':type', $this->type);
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

        public function delete()
        {
            $query = 'DELETE FROM ' . $this->table . '
                WHERE dnumber = :dnumber';
            $stmt = $this->conn->prepare($query);
            $this->dnumber = htmlspecialchars(strip_tags($this->dnumber));
            $stmt->bindParam(':dnumber', $this->dnumber);
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

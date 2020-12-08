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
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->dnumber = $row['dnumber'];
            $this->type = $row['type'];
        }

        public function insert()
        {
            $query = 'INSERT INTO ' . $this->table . '
                        SET type = :type';
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->prepare($query);
            $this->type = htmlspecialchars(strip_tags($this->type));
            $stmt->bindParam(':type', $this->type);
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

        public function delete()
        {
            $query = 'DELETE FROM ' . $this->table . '
                WHERE dnumber = :dnumber';
            $stmt = $this->conn->prepare($query);
            $this->dnumber = htmlspecialchars(strip_tags($this->dnumber));
            $stmt->bindParam(':dnumber', $this->dnumber);
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

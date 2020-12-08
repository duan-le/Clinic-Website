<?php
    class Receipt {
        private $conn;
        private $table = 'receipt';

        public $number;
        public $date;

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
            $query = 'SELECT * FROM ' . $this->table . ' WHERE number = ?';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->number);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->number = $row['number'];
            $this->date = $row['date'];
        }

        public function insert()
        {
            $query = 'INSERT INTO ' . $this->table . '
                        SET number = ?,
                            date = ?';
            $stmt = $this->conn->prepare($query);
            $this->number = htmlspecialchars(strip_tags($this->number));
            $this->date = htmlspecialchars(strip_tags($this->date));
            $stmt->bindParam(1, $this->number);
            $stmt->bindParam(2, $this->date);
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
                SET date = ?
                WHERE number = ?';
            $stmt = $this->conn->prepare($query);
            $this->number = htmlspecialchars(strip_tags($this->number));
            $this->date = htmlspecialchars(strip_tags($this->date));
            $stmt->bindParam(1, $this->date);
            $stmt->bindParam(2, $this->number);
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
                WHERE number = ?';
            $stmt = $this->conn->prepare($query);
            $this->number = htmlspecialchars(strip_tags($this->number));
            $stmt->bindParam(1, $this->number);
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

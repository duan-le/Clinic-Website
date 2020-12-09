<?php
    class Receipt {
        private $conn;

        public $number;
        public $date;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function view() {
            $query = "CALL receipt_view()";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function search() {
            $this->strip();
            $query = "CALL receipt_search('$this->number')";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function insert()
        {
            $this->strip();
            $query = "CALL receipt_insert('$this->number','$this->date')";
            $stmt = $this->conn->prepare($query);
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
            $this->strip();
            $query = "CALL receipt_update('$this->date','$this->number')";
            $stmt = $this->conn->prepare($query);
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
            $this->strip();
            $query = "CALL receipt_delete('$this->number')";
            $stmt = $this->conn->prepare($query);
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
      public function strip(){
        $this->number = htmlspecialchars(strip_tags($this->number));
        $this->date = htmlspecialchars(strip_tags($this->date));
      }
    }

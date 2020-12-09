<?php
    class Service {
        private $conn;

        public $name;
        public $price;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function view() {
            $query = "CALL service_view()";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function search() {
            $this->strip();
            $query = "CALL service_search('$this->name')";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function insert() {
          if (
            $this->name == null ||
            $this->price == null
          ) return false;
            $this->strip();
            $query = "CALL service_insert('$this->name','$this->price')";
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

        public function update() {
          if (
            $this->name == null ||
            $this->price == null
          ) return false;
          $this->strip();
          $query = "CALL service_update('$this->price','$this->name')";
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

        public function delete() {
          $this->strip();
          $query = "CALL service_delete('$this->name')";
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
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
      }
    }

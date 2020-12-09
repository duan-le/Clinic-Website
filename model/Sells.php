<?php
	class Sells {
		private $conn;

		public $dnumber;
		public $product_id;

		public function __construct($db) {
      $this->conn = $db;
		}

		public function view() {
			$query = "CALL sells_view()";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function search() {
			$this->strip();
			$query = "CALL sells_search('$this->dnumber')";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function insert() {
			if (
				$this->dnumber == null ||
				$this->product_id == null
			) return false;
			$this->strip();
			$query = "CALL sells_insert('$this->dnumber','$this->product_id')";
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
			$query = "CALL sells_delete('$this->dnumber','$this->product_id')";
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
			$this->dnumber = htmlspecialchars(strip_tags($this->dnumber));
			$this->product_id = htmlspecialchars(strip_tags($this->product_id));
		}
	}

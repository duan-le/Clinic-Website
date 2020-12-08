<?php
	class Sells {
		private $conn;
		private $table = 'sells';

		public $dnumber;
		public $product_id;

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
			$query = 'SELECT * FROM ' . $this->table . ' WHERE dnumber = ?';
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->dnumber);
			$stmt->execute();
			return $stmt;
		}

		public function insert() {
			$query = 'INSERT INTO ' . $this->table . ' SET dnumber = ?, product_id = ?';
			$stmt = $this->conn->prepare($query);
			$this->dnumber = htmlspecialchars(strip_tags($this->dnumber));
			$this->product_id = htmlspecialchars(strip_tags($this->product_id));
			$stmt->bindParam(1, $this->dnumber);
			$stmt->bindParam(2, $this->product_id);
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
			$query = 'DELETE FROM ' . $this->table . ' WHERE dnumber = ? AND product_id = ?';
			$stmt = $this->conn->prepare($query);
			$this->dnumber = htmlspecialchars(strip_tags($this->dnumber));
			$this->product_id = htmlspecialchars(strip_tags($this->product_id));
			$stmt->bindParam(1, $this->dnumber);
			$stmt->bindParam(2, $this->product_id);
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

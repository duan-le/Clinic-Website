<?php
	class ProductReceipt {
		private $conn;
		private $table = 'product_receipt';
		
		public $product_id;
		public $receipt_number;

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
			$query = 'SELECT * FROM ' . $this->table . ' WHERE product_id = ? AND receipt_number = ?';
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->product_id);
			$stmt->bindParam(2, $this->receipt_number);
			$stmt->execute();
			return $stmt;
		}

		public function insert() {
			$query = 'INSERT INTO ' . $this->table . ' SET product_id = ?, receipt_number = ?';
			$stmt = $this->conn->prepare($query);
			$this->product_id = htmlspecialchars(strip_tags($this->product_id));
			$this->receipt_number = htmlspecialchars(strip_tags($this->receipt_number));
			$stmt->bindParam(1, $this->product_id);
			$stmt->bindParam(2, $this->receipt_number);
			if ($stmt->execute()) {
				return true;
			} else {
				printf("Error: %s.\n", $stmt->error);
				return false;
			}
		}

		public function delete() {
			$query = 'DELETE FROM ' . $this->table . ' WHERE product_id = ? AND receipt_number = ?';
			$stmt = $this->conn->prepare($query);
			$this->product_id = htmlspecialchars(strip_tags($this->product_id));
			$this->receipt_number = htmlspecialchars(strip_tags($this->receipt_number));
			$stmt->bindParam(1, $this->product_id);
			$stmt->bindParam(2, $this->receipt_number);
			if ($stmt->execute()) {
				return true;
			} else {
				printf("Error: %s.\n", $stmt->error);
				return false;
			}
		}
	}

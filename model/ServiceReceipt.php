<?php
	class ServiceReceipt {
		private $conn;
		private $table = 'service_receipt';
		
		public $service_name;
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
			$query = 'SELECT * FROM ' . $this->table . ' WHERE service_name = ? AND receipt_number = ?';
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->service_name);
			$stmt->bindParam(2, $this->receipt_number);
			$stmt->execute();
			return $stmt;
		}

		public function insert() {
			$query = 'INSERT INTO ' . $this->table . ' SET service_name = ?, receipt_number = ?';
			$stmt = $this->conn->prepare($query);
			$this->service_name = htmlspecialchars(strip_tags($this->service_name));
			$this->receipt_number = htmlspecialchars(strip_tags($this->receipt_number));
			$stmt->bindParam(1, $this->service_name);
			$stmt->bindParam(2, $this->receipt_number);
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
			$query = 'DELETE FROM ' . $this->table . ' WHERE service_name = ? AND receipt_number = ?';
			$stmt = $this->conn->prepare($query);
			$this->service_name = htmlspecialchars(strip_tags($this->service_name));
			$this->receipt_number = htmlspecialchars(strip_tags($this->receipt_number));
			$stmt->bindParam(1, $this->service_name);
			$stmt->bindParam(2, $this->receipt_number);
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

<?php
	class BankAccount {
		private $conn;
		private $table = 'bank_account';
		
		public $account_number;
		public $account_type;
		public $employee_id;

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
			$query = 'SELECT * FROM ' . $this->table . ' WHERE employee_id = ?';
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->employee_id);
			$stmt->execute();
			return $stmt;
		}

		public function insert() {
			$query = 'INSERT INTO ' . $this->table . ' SET account_number = ?, account_type = ?, employee_id = ?';
			$stmt = $this->conn->prepare($query);
			$this->account_number = htmlspecialchars(strip_tags($this->account_number));
			$this->account_type = htmlspecialchars(strip_tags($this->account_type));
			$this->employee_id = htmlspecialchars(strip_tags($this->employee_id));
			$stmt->bindParam(1, $this->account_number);
			$stmt->bindParam(2, $this->account_type);
			$stmt->bindParam(3, $this->employee_id);
			if ($stmt->execute()) {
				return true;
			} else {
				printf("Error: %s.\n", $stmt->error);
				return false;
			}
		}

		public function update() {
			$query = 'UPDATE ' . $this->table . ' SET account_number = ?, account_type = ? WHERE employee_id = ?';
			$stmt = $this->conn->prepare($query);
			$this->account_number = htmlspecialchars(strip_tags($this->account_number));
			$this->account_type = htmlspecialchars(strip_tags($this->account_type));
			$this->employee_id = htmlspecialchars(strip_tags($this->employee_id));
			$stmt->bindParam(1, $this->account_number);
			$stmt->bindParam(2, $this->account_type);
			$stmt->bindParam(3, $this->employee_id);
			if ($stmt->execute()) {
				return true;
			} else {
				printf("Error: %s.\n", $stmt->error);
				return false;
			}
		}
	}

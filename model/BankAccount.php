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
	}
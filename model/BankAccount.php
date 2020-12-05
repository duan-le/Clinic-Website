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
	}
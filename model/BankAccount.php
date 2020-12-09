<?php
	class BankAccount {
		private $conn;

		public $account_number;
		public $account_type;
		public $employee_id;

		public function __construct($db) {
      $this->conn = $db;
		}

		public function view() {
			$query = "CALL bankaccount_view()";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function search() {
			$this->strip();
			$query = "CALL bankaccount_search('$this->employee_id')";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function insert() {
			if (
				$this->account_number == null ||
				$this->account_type == null ||
				$this->employee_id == null
			) return false;
			$this->strip();
			$query = "CALL bankaccount_insert('$this->account_number','$this->account_type','$this->employee_id')";
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
				$this->account_number == null ||
				$this->account_type == null ||
				$this->employee_id == null
			) return false;
			$this->strip();
			$query = "CALL bankaccount_update('$this->account_number','$this->account_type','$this->employee_id')";
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
			$query = "CALL bankaccount_delete('$this->employee_id')";
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
			$this->account_number = htmlspecialchars(strip_tags($this->account_number));
			$this->account_type = htmlspecialchars(strip_tags($this->account_type));
			$this->employee_id = htmlspecialchars(strip_tags($this->employee_id));
		}
	}

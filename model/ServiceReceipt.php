<?php
	class ServiceReceipt {
		private $conn;

		public $service_name;
		public $receipt_number;

		public function __construct($db) {
      $this->conn = $db;
		}

		public function view() {
			$query = "CALL servicereceipt_view()";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function search() {
			$this->strip();
			$query = "CALL servicereceipt_search('$this->receipt_number')";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function insert() {
			if (
				$this->service_name == null ||
				$this->receipt_number == null
			) return false;
			$this->strip();
			$query = "CALL servicereceipt_insert('$this->service_name','$this->receipt_number')";
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
			$query = "CALL servicereceipt_delete('$this->service_name','$this->receipt_number')";
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
			$this->service_name = htmlspecialchars(strip_tags($this->service_name));
			$this->receipt_number = htmlspecialchars(strip_tags($this->receipt_number));
		}
	}

<?php
	class ProductReceipt {
		private $conn;

		public $product_id;
		public $receipt_number;

		public function __construct($db) {
      $this->conn = $db;
		}

		public function view() {
			$query = "CALL productreceipt_view()";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function search() {
			$this->strip();
			$query = "CALL productreceipt_search('$this->receipt_number')";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function insert() {
			if (
				$this->product_id == null ||
				$this->receipt_number == null
			) return false;
			$this->strip();
			$query = "CALL productreceipt_insert('$this->product_id','$this->receipt_number')";
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
			$query = "CALL productreceipt_delete('$this->product_id','$this->receipt_number')";
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
			$this->product_id = htmlspecialchars(strip_tags($this->product_id));
			$this->receipt_number = htmlspecialchars(strip_tags($this->receipt_number));
		}
	}

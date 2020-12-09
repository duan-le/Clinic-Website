<?php
	class Calendar {
		private $conn;

		public $month;
		public $year;

		public function __construct($db) {
      $this->conn = $db;
		}

		public function view() {
			$query = "CALL calendar_view()";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function search() {
			$this->strip();
			$query = "CALL calendar_search('$this->year')";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function insert() {
			if (
				$this->month == null ||
				$this->year == null
			) return false;
			$this->strip();
			$query = "CALL calendar_insert('$this->month','$this->year')";
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
			$query = "CALL calendar_delete('$this->month','$this->year')";
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
			$this->month = htmlspecialchars(strip_tags($this->month));
			$this->year = htmlspecialchars(strip_tags($this->year));
		}
	}

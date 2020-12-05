<?php
	class Calendar {
		private $conn;
		private $table = 'calendar';
		
		public $month;
		public $year;

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
			$query = 'SELECT * FROM ' . $this->table . ' WHERE month = ? AND year = ?';
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->month);
			$stmt->bindParam(2, $this->year);
			$stmt->execute();
			return $stmt;
		}

		public function insert() {
			$query = 'INSERT INTO ' . $this->table . ' SET month = ?, year = ?';
			$stmt = $this->conn->prepare($query);
			$this->month = htmlspecialchars(strip_tags($this->month));
			$this->year = htmlspecialchars(strip_tags($this->year));
			$stmt->bindParam(1, $this->month);
			$stmt->bindParam(2, $this->year);
			if ($stmt->execute()) {
				return true;
			} else {
				printf("Error: %s.\n", $stmt->error);
				return false;
			}
		}

		public function delete() {
			$query = 'DELETE FROM ' . $this->table . ' WHERE month = ? AND year = ?';
			$stmt = $this->conn->prepare($query);
			$this->month = htmlspecialchars(strip_tags($this->month));
			$this->year = htmlspecialchars(strip_tags($this->year));
			$stmt->bindParam(1, $this->month);
			$stmt->bindParam(2, $this->year);
			if ($stmt->execute()) {
				return true;
			} else {
				printf("Error: %s.\n", $stmt->error);
				return false;
			}
		}
	}

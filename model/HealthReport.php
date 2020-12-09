<?php
  class HealthReport {
    private $conn;

    public $client_id;
    public $date;

    public function __construct($db) {
      $this->conn = $db;
    }

    public function view() {
			$query = "CALL healthreport_view()";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

    public function search() {
      $this->strip();
      $query = "CALL healthreport_search('$this->client_id')";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

    public function insert() {
			if (
				$this->client_id == null ||
				$this->date == null
			) return false;
      $this->strip();
      $query = "CALL healthreport_insert('$this->client_id','$this->date')";
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
      $query = "CALL healthreport_delete('$this->client_id','$this->date')";
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
      $this->client_id = htmlspecialchars(strip_tags($this->client_id));
			$this->date = htmlspecialchars(strip_tags($this->date));
    }
	}

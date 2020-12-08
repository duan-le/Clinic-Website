<?php
  class HealthReport {
    private $conn;
    private $table = 'health_report';

    public $client_id;
    public $date;

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
			$query = 'SELECT * FROM ' . $this->table . ' WHERE client_id = ?';
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->client_id);
			$stmt->execute();
			return $stmt;
		}

    public function insert() {
			$query = 'INSERT INTO ' . $this->table . ' SET client_id = ?, date = ?';
			$stmt = $this->conn->prepare($query);
			$this->client_id = htmlspecialchars(strip_tags($this->client_id));
			$this->date = htmlspecialchars(strip_tags($this->date));
			$stmt->bindParam(1, $this->client_id);
			$stmt->bindParam(2, $this->date);
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
			$query = 'DELETE FROM ' . $this->table . ' WHERE client_id = ? AND date = ?';
			$stmt = $this->conn->prepare($query);
      $this->client_id = htmlspecialchars(strip_tags($this->client_id));
			$this->date = htmlspecialchars(strip_tags($this->date));
			$stmt->bindParam(1, $this->client_id);
			$stmt->bindParam(2, $this->date);
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

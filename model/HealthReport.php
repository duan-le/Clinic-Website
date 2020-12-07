<?php
  class HealthReport {
    // DB stuff
    private $conn;
    private $table = 'health_report';

    // Post Properties
    public $client_id;
    public $date;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    public function view() {
			$query = 'SELECT * FROM ' . $this->table;
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

    // Get Single Category
    public function search() {
			$query = 'SELECT * FROM ' . $this->table . ' WHERE client_id = ?';
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->client_id);
			$stmt->execute();
			return $stmt;
		}

    // Create Post
    public function insert() {
			$query = 'INSERT INTO ' . $this->table . ' SET client_id = ?, date = ?';
			$stmt = $this->conn->prepare($query);
			$this->client_id = htmlspecialchars(strip_tags($this->client_id));
			$this->date = htmlspecialchars(strip_tags($this->date));
			$stmt->bindParam(1, $this->client_id);
			$stmt->bindParam(2, $this->date);
			if ($stmt->execute()) {
				return true;
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
				return true;
			} else {
				printf("Error: %s.\n", $stmt->error);
				return false;
			}
		}
	}

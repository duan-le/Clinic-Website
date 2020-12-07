<?php
  class Appointment {

    private $conn;
    private $table = 'appointment';

    public $appoint_id;
    public $day;
    public $month;
    public $year;
    public $time;
    public $client_id;
    public $employee_id;
    public $service_name;

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
			$query = 'SELECT * FROM ' . $this->table . ' WHERE appoint_id = ?';
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->appoint_id);
			$stmt->execute();
			return $stmt;
		}

		public function insert() {
			$query = 'INSERT INTO ' . $this->table . ' SET appoint_id = ?, day = ?, month = ?, year = ?, time = ?, client_id = ?, employee_id = ?, service_name = ?';
			$stmt = $this->conn->prepare($query);
			$this->appoint_id = htmlspecialchars(strip_tags($this->appoint_id));
			$this->day = htmlspecialchars(strip_tags($this->day));
			$this->month = htmlspecialchars(strip_tags($this->month));
      $this->year = htmlspecialchars(strip_tags($this->year));
      $this->time = htmlspecialchars(strip_tags($this->time));
      $this->client_id = htmlspecialchars(strip_tags($this->client_id));
      $this->employee_id = htmlspecialchars(strip_tags($this->employee_id));
      $this->service_name = htmlspecialchars(strip_tags($this->service_name));
			$stmt->bindParam(1, $this->appoint_id);
			$stmt->bindParam(2, $this->day);
			$stmt->bindParam(3, $this->month);
      $stmt->bindParam(4, $this->year);
      $stmt->bindParam(5, $this->time);
      $stmt->bindParam(6, $this->client_id);
      $stmt->bindParam(7, $this->employee_id);
      $stmt->bindParam(8, $this->service_name);
			if ($stmt->execute()) {
				return true;
			} else {
				printf("Error: %s.\n", $stmt->error);
				return false;
			}
		}

		public function update() {
      $query = 'UPDATE ' . $this->table . ' SET day = ?, month = ?, year = ?, time = ?, client_id = ?, employee_id = ?, service_name = ? WHERE appoint_id = ?';
			$stmt = $this->conn->prepare($query);
			$this->appoint_id = htmlspecialchars(strip_tags($this->appoint_id));
			$this->day = htmlspecialchars(strip_tags($this->day));
			$this->month = htmlspecialchars(strip_tags($this->month));
      $this->year = htmlspecialchars(strip_tags($this->year));
      $this->time = htmlspecialchars(strip_tags($this->time));
      $this->client_id = htmlspecialchars(strip_tags($this->client_id));
      $this->employee_id = htmlspecialchars(strip_tags($this->employee_id));
      $this->service_name = htmlspecialchars(strip_tags($this->service_name));
			$stmt->bindParam(8, $this->appoint_id);
			$stmt->bindParam(1, $this->day);
			$stmt->bindParam(2, $this->month);
      $stmt->bindParam(3, $this->year);
      $stmt->bindParam(4, $this->time);
      $stmt->bindParam(5, $this->client_id);
      $stmt->bindParam(6, $this->employee_id);
      $stmt->bindParam(7, $this->service_name);
			if ($stmt->execute()) {
				return true;
			} else {
				printf("Error: %s.\n", $stmt->error);
				return false;
			}
		}

    public function delete() {
			$query = 'DELETE FROM ' . $this->table . ' WHERE appoint_id = ?';
			$stmt = $this->conn->prepare($query);
			$this->appoint_id = htmlspecialchars(strip_tags($this->appoint_id));
			$stmt->bindParam(1, $this->appoint_id);
			if ($stmt->execute()) {
				return true;
			} else {
				printf("Error: %s.\n", $stmt->error);
				return false;
			}
		}
	}

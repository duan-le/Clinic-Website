<?php
  class Appointment {
    private $conn;

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
      $query = "CALL appointment_view()";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function search() {
      $this->strip();
      $query = "CALL appointment_search('$this->appoint_id')";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			return $stmt;
		}

		public function insert() {
			$this->strip();
      $query = "CALL appointment_insert('$this->day','$this->month','$this->year','$this->time','$this->client_id','$this->employee_id','$this->service_name')";
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
      $this->strip();
      $query = "CALL appointment_update('$this->day','$this->month','$this->year','$this->time','$this->client_id','$this->employee_id','$this->service_name','$this->appoint_id')";
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
      $query = "CALL appointment_delete('$this->appoint_id')";
			$stmt = $this->conn->prepare($query);

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
    public function strip(){
      $this->appoint_id = htmlspecialchars(strip_tags($this->appoint_id));
      $this->day = htmlspecialchars(strip_tags($this->day));
      $this->month = htmlspecialchars(strip_tags($this->month));
      $this->year = htmlspecialchars(strip_tags($this->year));
      $this->time = htmlspecialchars(strip_tags($this->time));
      $this->client_id = htmlspecialchars(strip_tags($this->client_id));
      $this->employee_id = htmlspecialchars(strip_tags($this->employee_id));
      $this->service_name = htmlspecialchars(strip_tags($this->service_name));
    }
	}

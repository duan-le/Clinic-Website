<?php
  class Client {
    private $conn;

    public $user_id;
    public $first_name;
    public $last_name;
    public $password;
    public $birthdate;
    public $address;
    public $phone_number;
    public $sex;

    public function __construct($db) {
      $this->conn = $db;
    }

    public function view() {
      $query = "CALL client_view()";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt;
    }

    public function search() {
      $this->strip();
      $query = "CALL client_search('$this->user_id')";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt;
    }

    public function insert() {
      if (
        $this->first_name == null ||
        $this->last_name == null ||
        $this->password == null ||
        $this->birthdate == null ||
        $this->address == null ||
        $this->phone_number == null ||
        $this->sex == null
			) return false;
      $this->strip();
      $query = "CALL client_insert('$this->first_name','$this->last_name','$this->password','$this->birthdate','$this->address','$this->phone_number','$this->sex')";
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
				$this->user_id == null ||
        $this->first_name == null ||
        $this->last_name == null ||
        $this->password == null ||
        $this->birthdate == null ||
        $this->address == null ||
        $this->phone_number == null ||
        $this->sex == null
			) return false;
      $this->strip();
      $query = "CALL client_update('$this->first_name','$this->last_name','$this->password','$this->birthdate','$this->address','$this->phone_number','$this->sex','$this->user_id')";
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
      $query = "CALL client_delete('$this->user_id')";
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
      $this->user_id = htmlspecialchars(strip_tags($this->user_id));
      $this->first_name = htmlspecialchars(strip_tags($this->first_name));
      $this->last_name = htmlspecialchars(strip_tags($this->last_name));
      $this->password = htmlspecialchars(strip_tags($this->password));
      $this->birthdate = htmlspecialchars(strip_tags($this->birthdate));
      $this->address = htmlspecialchars(strip_tags($this->address));
      $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
      $this->sex = htmlspecialchars(strip_tags($this->sex));
    }
  }

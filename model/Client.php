<?php
  class Client {
    private $conn;
    private $table = 'client';

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
      $query = 'SELECT * FROM ' . $this->table;
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt;
    }

    public function search() {
      $query = 'SELECT * FROM ' . $this->table . ' WHERE user_id = ?';
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->user_id);
      $stmt->execute();
      return $stmt;
    }

    public function insert() {
      $query = 'INSERT INTO ' . $this->table . '
              SET user_id = :user_id,
                  first_name = :first_name,
                  last_name = :last_name,
                  password = :password,
                  birthdate = :birthdate,
                  address = :address,
                  phone_number = :phone_number,
                  sex = :sex';
      $stmt = $this->conn->prepare($query);
      $this->user_id = htmlspecialchars(strip_tags($this->user_id));
      $this->first_name = htmlspecialchars(strip_tags($this->first_name));
      $this->last_name = htmlspecialchars(strip_tags($this->last_name));
      $this->password = htmlspecialchars(strip_tags($this->password));
      $this->birthdate = htmlspecialchars(strip_tags($this->birthdate));
      $this->address = htmlspecialchars(strip_tags($this->address));
      $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
      $this->sex = htmlspecialchars(strip_tags($this->sex));
      $stmt->bindParam(':user_id', $this->user_id);
      $stmt->bindParam(':first_name', $this->first_name);
      $stmt->bindParam(':last_name', $this->last_name);
      $stmt->bindParam(':password', $this->password);
      $stmt->bindParam(':birthdate', $this->birthdate);
      $stmt->bindParam(':address', $this->address);
      $stmt->bindParam(':phone_number', $this->phone_number);
      $stmt->bindParam(':sex', $this->sex);
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
      $query = 'UPDATE ' . $this->table . '
              SET first_name = :first_name,
                  last_name = :last_name,
                  password = :password,
                  birthdate = :birthdate,
                  address = :address,
                  phone_number = :phone_number,
                  sex = :sex
              WHERE user_id = :user_id';
      $stmt = $this->conn->prepare($query);
      $this->user_id = htmlspecialchars(strip_tags($this->user_id));
      $this->first_name = htmlspecialchars(strip_tags($this->first_name));
      $this->last_name = htmlspecialchars(strip_tags($this->last_name));
      $this->password = htmlspecialchars(strip_tags($this->password));
      $this->birthdate = htmlspecialchars(strip_tags($this->birthdate));
      $this->address = htmlspecialchars(strip_tags($this->address));
      $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
      $this->sex = htmlspecialchars(strip_tags($this->sex));
      $stmt->bindParam(':user_id', $this->user_id);
      $stmt->bindParam(':first_name', $this->first_name);
      $stmt->bindParam(':last_name', $this->last_name);
      $stmt->bindParam(':password', $this->password);
      $stmt->bindParam(':birthdate', $this->birthdate);
      $stmt->bindParam(':address', $this->address);
      $stmt->bindParam(':phone_number', $this->phone_number);
      $stmt->bindParam(':sex', $this->sex);
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
      $query = 'DELETE FROM ' . $this->table . '
              WHERE user_id = :user_id';
      $stmt = $this->conn->prepare($query);
      $this->user_id = htmlspecialchars(strip_tags($this->user_id));
      $stmt->bindParam(':user_id', $this->user_id);
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
  }

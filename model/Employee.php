
<?php
class Employee
{
  private $conn;

  public $user_id;
  public $first_name;
  public $last_name;
  public $password;
  public $birthdate;
  public $address;
  public $phone_number;
  public $sex;
  public $start_date;
  public $wage;
  public $hours;
  public $SIN;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function view()
  {
    $query = "CALL employee_view()";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  public function search()
  {
    $this->strip();
    $query = "CALL employee_search('$this->user_id')";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  public function insert()
  {
    $this->strip();
    $query = "CALL employee_insert('$this->user_id','$this->first_name','$this->last_name','$this->password','$this->birthdate','$this->address','$this->phone_number',
    '$this->sex','$this->start_date,'$this->wage,'$this->hours,'$this->SIN)";
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

  public function update()
  {
    $this->strip();
    $query = "CALL employee_update('$this->first_name','$this->last_name','$this->password','$this->birthdate','$this->address','$this->phone_number',
    '$this->sex','$this->start_date,'$this->wage,'$this->hours,'$this->SIN,'$this->user_id')";
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

  public function delete()
  {
    $this->strip();
    $query = "CALL employee_delete('$this->user_id')";
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
  public function strip()
  {
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));
    $this->first_name = htmlspecialchars(strip_tags($this->first_name));
    $this->last_name = htmlspecialchars(strip_tags($this->last_name));
    $this->password = htmlspecialchars(strip_tags($this->password));
    $this->birthdate = htmlspecialchars(strip_tags($this->birthdate));
    $this->address = htmlspecialchars(strip_tags($this->address));
    $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
    $this->sex = htmlspecialchars(strip_tags($this->sex));
    $this->start_date = htmlspecialchars(strip_tags($this->start_date));
    $this->wage = htmlspecialchars(strip_tags($this->wage));
    $this->hours = htmlspecialchars(strip_tags($this->hours));
    $this->SIN = htmlspecialchars(strip_tags($this->SIN));
  }
}

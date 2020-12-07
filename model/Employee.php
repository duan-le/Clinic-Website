
<?php
class Employee
{
  // DB Stuff
  private $conn;
  private $table = 'employee';

  // Properties
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

  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Get categories
  public function view()
  {
    // Create query
    $query = 'SELECT *
              FROM ' . $this->table;

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }

  // Get Single Category
  public function search()
  {
    // Create query
    $query = 'SELECT *
            FROM ' . $this->table . '
            WHERE user_id = ?';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(1, $this->user_id);

    // Execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // set properties
    $this->user_id = $row['user_id'];
    $this->first_name = $row['first_name'];
    $this->last_name = $row['last_name'];
    $this->password = $row['password'];
    $this->birthdate = $row['birthdate'];
    $this->address = $row['address'];
    $this->phone_number = $row['phone_number'];
    $this->sex = $row['sex'];
    $this->start_date = $row['start_date'];
    $this->wage = $row['wage'];
    $this->hours = $row['hours'];
    $this->SIN = $row['SIN'];
  }

  // Create Category
  public function insert()
  {
    // Create Query
    $query = 'INSERT INTO ' . $this->table . '
            SET first_name = :first_name,
                last_name = :last_name,
                password = :password,
                birthdate = :birthdate,
                address = :address,
                phone_number = :phone_number,
                sex = :sex,
                start_date = :start_date,
                wage = :wage,
                hours = :hours,
                SIN = :SIN';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
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

    // Bind data
    $stmt->bindParam(':first_name', $this->first_name);
    $stmt->bindParam(':last_name', $this->last_name);
    $stmt->bindParam(':password', $this->password);
    $stmt->bindParam(':birthdate', $this->birthdate);
    $stmt->bindParam(':address', $this->address);
    $stmt->bindParam(':phone_number', $this->phone_number);
    $stmt->bindParam(':sex', $this->sex);
    $stmt->bindParam(':start_date', $this->start_date);
    $stmt->bindParam(':wage', $this->wage);
    $stmt->bindParam(':hours', $this->hours);
    $stmt->bindParam(':SIN', $this->SIN);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  // Update Category
  public function update()
  {
    // Create Query
    $query = 'UPDATE ' . $this->table . '
            SET first_name = :first_name,
                last_name = :last_name,
                password = :password,
                birthdate = :birthdate,
                address = :address,
                phone_number = :phone_number,
                sex = :sex,
                start_date = :start_date,
                wage = :wage,
                hours = :hours,
                SIN = :SIN
            WHERE user_id = :user_id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
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

    // Bind data
    $stmt->bindParam(':user_id', $this->user_id);
    $stmt->bindParam(':first_name', $this->first_name);
    $stmt->bindParam(':last_name', $this->last_name);
    $stmt->bindParam(':password', $this->password);
    $stmt->bindParam(':birthdate', $this->birthdate);
    $stmt->bindParam(':address', $this->address);
    $stmt->bindParam(':phone_number', $this->phone_number);
    $stmt->bindParam(':sex', $this->sex);
    $stmt->bindParam(':start_date', $this->start_date);
    $stmt->bindParam(':wage', $this->wage);
    $stmt->bindParam(':hours', $this->hours);
    $stmt->bindParam(':SIN', $this->SIN);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  // Delete Category
  public function delete()
  {
    // Create query
    $query = 'DELETE FROM ' . $this->table . '
            WHERE user_id = :user_id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));

    // Bind Data
    $stmt->bindParam(':user_id', $this->user_id);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }
}

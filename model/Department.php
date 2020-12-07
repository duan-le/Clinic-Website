
<?php
class Department
{
    // DB Stuff
    private $conn;
    private $table = 'department';

    // Properties
    public $dnumber;
    public $type;

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
            WHERE dnumber = ?';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->dnumber);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->dnumber = $row['dnumber'];
        $this->type = $row['type'];
    }

    // Create Category
    public function insert()
    {
        // Create Query
        $query = 'INSERT INTO ' . $this->table . '
                    SET type = :type';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->type = htmlspecialchars(strip_tags($this->type));

        // Bind data
        $stmt->bindParam(':type', $this->type);

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
            SET type = :type
            WHERE dnumber = :dnumber';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->dnumber = htmlspecialchars(strip_tags($this->dnumber));
        $this->type = htmlspecialchars(strip_tags($this->type));

        // Bind data
        $stmt->bindParam(':dnumber', $this->dnumber);
        $stmt->bindParam(':type', $this->type);

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
            WHERE dnumber = :dnumber';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->dnumber = htmlspecialchars(strip_tags($this->dnumber));

        // Bind Data
        $stmt->bindParam(':dnumber', $this->dnumber);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}

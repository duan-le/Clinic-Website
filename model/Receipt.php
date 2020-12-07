
<?php
class Receipt
{
    // DB Stuff
    private $conn;
    private $table = 'receipt';

    // Properties
    public $number;
    public $date;

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
            WHERE number = ?';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->number);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->number = $row['number'];
        $this->date = $row['date'];
    }

    // Create Category
    public function insert()
    {
        // Create Query
        $query = 'INSERT INTO ' . $this->table . '
                    SET number = ?,
                        date = ?';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);
        // Clean data
        $this->number = htmlspecialchars(strip_tags($this->number));
        $this->date = htmlspecialchars(strip_tags($this->date));

        // Bind data
        $stmt->bindParam(1, $this->number);
        $stmt->bindParam(2, $this->date);

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
            SET date = ?
            WHERE number = ?';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->number = htmlspecialchars(strip_tags($this->number));
        $this->date = htmlspecialchars(strip_tags($this->date));

        // Bind data
        $stmt->bindParam(1, $this->date);
        $stmt->bindParam(2, $this->number);

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
            WHERE number = ?';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->number = htmlspecialchars(strip_tags($this->number));

        // Bind Data
        $stmt->bindParam(1, $this->number);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}

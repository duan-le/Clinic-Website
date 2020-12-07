
<?php
class Service
{
    // DB Stuff
    private $conn;
    private $table = 'service';

    // Properties
    public $name;
    public $price;

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
            WHERE name = ?';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->name);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->name = $row['name'];
        $this->price = $row['price'];
    }

    // Create Category
    public function insert()
    {
        // Create Query
        $query = 'INSERT INTO ' . $this->table . '
                    SET name = :name,
                        price = :price';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));

        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);

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
            SET price = :price
            WHERE name = :name';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));

        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);

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
            WHERE name = :name';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->name = htmlspecialchars(strip_tags($this->name));

        // Bind Data
        $stmt->bindParam(':name', $this->name);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}

<?php
class PurchasedBy
{
    // DB Stuff
    private $conn;
    private $table = 'purchased_by';

    // Properties
    public $product_id;
    public $user_id;

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
            FROM ' . $this->table . ' WHERE product_id = ?';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->product_id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->product_id = $row['product_id'];
        $this->user_id = $row['user_id'];
    }

    // Create Category
    public function insert()
    {
        // Create Query
        $query = 'INSERT INTO ' . $this->table . '
                    SET product_id = ?,
                        user_id = ?';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        // Bind data
        $stmt->bindParam(1, $this->product_id);
        $stmt->bindParam(2, $this->user_id);

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
            WHERE product_id = ? AND user_id = ?';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->user = htmlspecialchars(strip_tags($this->user_id));

        // Bind Data
        $stmt->bindParam(1, $this->product_id);
        $stmt->bindParam(2, $this->user_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}

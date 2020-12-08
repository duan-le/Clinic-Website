<?php
    class PurchasedBy
    {
        private $conn;
        private $table = 'purchased_by';

        public $product_id;
        public $user_id;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function view()
        {
            $query = 'SELECT *
                FROM ' . $this->table;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function search()
        {
            $query = 'SELECT *
                FROM ' . $this->table . ' WHERE product_id = ?';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->product_id);
            $stmt->execute();
            return $stmt;
        }

        public function insert()
        {
            $query = 'INSERT INTO ' . $this->table . '
                        SET product_id = ?,
                            user_id = ?';
            $stmt = $this->conn->prepare($query);
            $this->product_id = htmlspecialchars(strip_tags($this->product_id));
            $this->user_id = htmlspecialchars(strip_tags($this->user_id));
            $stmt->bindParam(1, $this->product_id);
            $stmt->bindParam(2, $this->user_id);
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
            $query = 'DELETE FROM ' . $this->table . '
                WHERE product_id = ? AND user_id = ?';
            $stmt = $this->conn->prepare($query);
            $this->product_id = htmlspecialchars(strip_tags($this->product_id));
            $this->user = htmlspecialchars(strip_tags($this->user_id));
            $stmt->bindParam(1, $this->product_id);
            $stmt->bindParam(2, $this->user_id);
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

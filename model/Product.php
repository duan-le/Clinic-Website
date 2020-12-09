<?php
    class Product
    {
        private $conn;

        public $product_id;
        public $name;
        public $price;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function view()
        {
            $query = "CALL product_view()";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function search()
        {
            $this->strip();
            $query = "CALL product_search('$this->product_id')";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function insert()
        {
          if (
            $this->name == null ||
            $this->price == null
          ) return false;
            $this->strip();
            $query = "CALL product_insert('$this->name','$this->price')";
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
          if (
            $this->product_id == null ||
            $this->name == null ||
            $this->price == null
          ) return false;
          $this->strip();
          $query = "CALL product_update('$this->name','$this->price','$this->product_id')";
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
            $query = "CALL product_delete('$this->product_id')";
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
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
      }

    }

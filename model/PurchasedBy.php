<?php
    class PurchasedBy
    {
        private $conn;

        public $product_id;
        public $user_id;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function view()
        {
            $query = "CALL purchasedby_view()";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function search()
        {
            $this->strip();
            $query = "CALL purchasedby_search('$this->user_id')";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function insert()
        {
          if (
            $this->product_id == null ||
            $this->user_id == null
          ) return false;
            $this->strip();
            $query = "CALL purchasedby_insert('$this->product_id','$this->user_id')";
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
          $query = "CALL purchasedby_delete('$this->product_id','$this->user_id')";
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
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->user = htmlspecialchars(strip_tags($this->user_id));
      }
    }

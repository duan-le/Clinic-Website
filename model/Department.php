<?php
    class Department{
        private $conn;

        public $dnumber;
        public $type;

      public function __construct($db){
            $this->conn = $db;
        }

      public function view(){
            $query = "CALL department_view()";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

      public function search() {
            $this->strip();
            $query = "CALL department_search('$this->dnumber')";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->dnumber);
            $stmt->execute();
            return $stmt;
        }

      public function insert() {
        if (
          $this->type == null
        ) return false;
            $this->strip();
            $query = "CALL department_insert('$this->type')";
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

      public function update(){
        if (
          $this->dnumber == null ||
          $this->type == null
        ) return false;
        $this->strip();
        $query = "CALL department_update('$this->type','$this->dnumber')";
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

      public function delete(){
        $this->strip();
        $query = "CALL department_delete('$this->dnumber')";
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
          $this->dnumber = htmlspecialchars(strip_tags($this->dnumber));
          $this->type = htmlspecialchars(strip_tags($this->type));
      }
    }

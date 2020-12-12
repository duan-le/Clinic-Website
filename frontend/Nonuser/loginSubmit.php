<?php
      
      if(isset($_POST['login'])) { 
        session_start();
            
        include_once '../../config/Database.php';
      
        $user_id = $_POST['id'];
        $password = $_POST['password'];
      
        $database = new Database();
        $db = $database->connect();
      
        $query = 'SELECT user_id FROM employee WHERE user_id = ? AND password = ?'; // Admin ID is current statically set to 0
        $stmt = $db->prepare($query);
        $stmt->bindParam(1, $user_id);
        $stmt->bindParam(2, $password);
        $stmt->execute();
      
        if($stmt->rowCount() > 0) {
          if ($user_id == 0)
          {
            $_SESSION['user_type'] = 'admin';
            $_SESSION['login'] = 1;
            header("Location: http://localhost/massageClinic/frontend/Employee/home.php");
          } else {
            $_SESSION['user_type'] = 'employee';
            $_SESSION['login'] = 1;
            header("Location: http://localhost/massageClinic/frontend/Employee/home.php");
          }
          $_SESSION['user_id'] = $user_id;    
        } else {
          $_SESSION['login'] = 0;
        }

        if($_SESSION['login'] == 0) {
          $user_id = $_POST['id'];
          $password = $_POST['password'];
        
          $database = new Database();
          $db = $database->connect();
        
          $query = 'SELECT user_id FROM client WHERE user_id = ? AND password = ?'; // Admin ID is current statically set to 0
          $stmt = $db->prepare($query);
          $stmt->bindParam(1, $user_id);
          $stmt->bindParam(2, $password);
          $stmt->execute();
        
          if($stmt->rowCount() > 0) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_type'] = 'client';
            $_SESSION['login'] = 1;
            header("Location: http://localhost/massageClinic/frontend/Client/home.php");
          } else {
            $_SESSION['login'] = 0;
          }
        }
      } 
    ?>
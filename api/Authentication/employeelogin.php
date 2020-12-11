<?php
  session_start();

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';

  $data = json_decode(file_get_contents("php://input"));
  $user_id = $data->user_id;
  $password = $data->password;

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
      echo json_encode(array('message' => 'Admin Login Successful'));
    } else {
      $_SESSION['user_type'] = 'employee';
      echo json_encode(array('message' => 'Employee Login Successful'));
    }
    $_SESSION['user_id'] = $user_id;    
  } else {
    http_response_code(401);
    echo json_encode(array('message' => 'Login Failed'));
  }

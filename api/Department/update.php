<?php
  session_start();

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Department.php';

  if (isset($_SESSION['user_id'])
    && isset($_SESSION['user_type'])
    && $_SESSION['user_type'] == 'admin'
  ) {
    $database = new Database();
    $db = $database->connect();

    $department = new Department($db);
    $data = json_decode(file_get_contents("php://input"));

    $department->dnumber = $data->dnumber;
    $department->type = $data->type;

    if ($department->update()) {
      echo json_encode(
        array('message' => 'Department Updated')
      );
    } else {
      echo json_encode(
        array('message' => 'Department Not Updated')
      );
    }
  } else {
    http_response_code(401);
    echo json_encode(array('message' => 'You Are Not Authorized'));
  }

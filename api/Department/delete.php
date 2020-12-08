<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../model/Department.php';

  $database = new Database();
  $db = $database->connect();

  $department = new Department($db);
  $data = json_decode(file_get_contents("php://input"));
  $department->dnumber = $data->dnumber;

  if($department->delete()) {
    echo json_encode(
      array('message' => 'Department Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Department Not Deleted')
    );
  }
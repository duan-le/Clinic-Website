<?php
  session_start();

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Employee.php';

  if (isset($_SESSION['user_id'])
    && isset($_SESSION['user_type'])
    && $_SESSION['user_type'] == 'admin'
  ) {
    $database = new Database();
    $db = $database->connect();

    $employee = new Employee($db);
    $employee->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();
    $result = $employee->search();
    $num = $result->rowCount();
    $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
    if($num > 0) echo json_encode($rows);
    else echo json_encode(array('message' => 'No Employees Found'));
  } else {
    http_response_code(401);
    echo json_encode(array('message' => 'You Are Not Authorized'));
  }

<?php
  session_start();

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Appointment.php';

  if (isset($_SESSION['user_id'])
    && isset($_SESSION['user_type'])
    && $_SESSION['user_type'] == 'client'
  ) {
    $database = new Database();
    $db = $database->connect();
    $appointment = new Appointment($db);

    $appointment->client_id = $_SESSION['user_id'];
    $result = $appointment->clientsearch();
    $num = $result->rowCount();
    $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
    if($num > 0) echo json_encode($rows);
    else echo json_encode(array('message' => 'No Appointment Found'));
  
  } else if (isset($_SESSION['user_id'])
    && isset($_SESSION['user_type'])
    && $_SESSION['user_type'] == 'employee'
  ) {
    $database = new Database();
    $db = $database->connect();
    $appointment = new Appointment($db);

    $appointment->employee_id = $_SESSION['user_id'];
    $result = $appointment->employeesearch();
    $num = $result->rowCount();
    $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
    if($num > 0) echo json_encode($rows);
    else echo json_encode(array('message' => 'No Appointment Found'));
  
  } else {
    http_response_code(401);
    echo json_encode(array('message' => 'You Are Not Authorized'));
  }

<?php
  session_start();

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  if (isset($_SESSION['user_id'])
    && isset($_SESSION['user_type'])
    && ($_SESSION['user_type'] == 'employee'
    || $_SESSION['user_type'] == 'admin')
  ) {
    include_once '../../config/Database.php';
    include_once '../../model/Appointment.php';

    $database = new Database();
    $db = $database->connect();
    $appointment = new Appointment($db);

    $result = $appointment->view();
    $num = $result->rowCount();
    $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
    if($num > 0) echo json_encode($rows);
    else echo json_encode(array('message' => 'No Appointment Found'));
  } else {
    http_response_code(401);
    echo json_encode(array('message' => 'You Are Not Authorized'));
  }

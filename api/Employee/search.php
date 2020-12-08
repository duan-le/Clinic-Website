<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Employee.php';

  $database = new Database();
  $db = $database->connect();

  $employee = new Employee($db);
  $employee->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();
  $result = $employee->search();
  $num = $result->rowCount();

  if($num > 0) {
    $employee_arr = array();
    $employee_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $employee_item = array(
        'user_id' => $user_id,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'password' => $password,
        'birthdate' => $birthdate,
        'address' => $address,
        'phone_number' => $phone_number,
        'sex' => $sex,
        'start_date' => $start_date,
        'wage' => $wage,
        'hours' => $hours,
        'SIN' => $SIN
      );
      array_push($employee_arr['data'], $employee_item);
    }
    echo json_encode($employee_arr);

  } else {
    echo json_encode(
      array('message' => 'No Employees Found')
    );
  }
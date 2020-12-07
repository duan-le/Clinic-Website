<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Employee.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $employee = new Employee($db);

  // Get ID
  $employee->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

  // Get post
  $employee->search();

  // Create array
  $employee_arr = array(
    'user_id' => $employee->user_id,
    'first_name' => $employee->first_name,
    'last_name' => $employee->last_name,
    'password' => $employee->password,
    'birthdate' => $employee->birthdate,
    'address' => $employee->address,
    'phone_number' => $employee->phone_number,
    'sex' => $employee->sex,
    'start_date' => $employee->start_date,
    'wage' => $employee->wage,
    'hours' => $employee->hours,
    'SIN' => $employee->SIN,
  );

  // Make JSON
  print_r(json_encode($employee_arr));
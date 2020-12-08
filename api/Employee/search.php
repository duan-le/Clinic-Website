<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Employee.php';

  $database = new Database();
  $db = $database->connect();

  $employee = new Employee($db);
  $employee->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();
  $employee->search();

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

  print_r(json_encode($employee_arr));
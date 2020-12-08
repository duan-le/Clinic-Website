<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Department.php';

  $database = new Database();
  $db = $database->connect();

  $department = new Department($db);
  $department->dnumber = isset($_GET['dnumber']) ? $_GET['dnumber'] : die();
  $department->search();

  $department_arr = array(
    'dnumber' => $department->dnumber,
    'type' => $department->type,
  );

  print_r(json_encode($department_arr));
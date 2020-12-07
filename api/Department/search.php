<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Department.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $department = new Department($db);

  // Get ID
  $department->dnumber = isset($_GET['dnumber']) ? $_GET['dnumber'] : die();

  // Get post
  $department->search();

  // Create array
  $department_arr = array(
    'dnumber' => $department->dnumber,
    'type' => $department->type,
  );

  // Make JSON
  print_r(json_encode($department_arr));
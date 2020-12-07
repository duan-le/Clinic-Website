<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Service.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $service = new Service($db);

  // Get ID
  $service->name = isset($_GET['name']) ? $_GET['name'] : die();

  // Get post
  $service->search();

  // Create array
  $service_arr = array(
    'name' => $service->name,
    'price' => $service->price,
  );

  // Make JSON
  print_r(json_encode($service_arr));

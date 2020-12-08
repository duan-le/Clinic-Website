<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Service.php';

  $database = new Database();
  $db = $database->connect();

  $service = new Service($db);
  $service->name = isset($_GET['name']) ? $_GET['name'] : die();
  $service->search();

  $service_arr = array(
    'name' => $service->name,
    'price' => $service->price,
  );

  print_r(json_encode($service_arr));

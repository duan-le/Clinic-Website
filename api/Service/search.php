<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Service.php';

  $database = new Database();
  $db = $database->connect();

  $service = new Service($db);
  $service->name = isset($_GET['name']) ? $_GET['name'] : die();
  $result = $service->search();
  $num = $result->rowCount();
  $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
  if($num > 0) echo json_encode($rows);
  else echo json_encode(array('message' => 'No Services Found'));

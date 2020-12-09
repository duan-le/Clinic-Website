<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Department.php';

  $database = new Database();
  $db = $database->connect();

  $department = new Department($db);
  $department->dnumber = isset($_GET['dnumber']) ? $_GET['dnumber'] : die();
  $result = $department->search();
  $num = $result->rowCount();
  $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
  if($num > 0) echo json_encode($rows);
  else echo json_encode(array('message' => 'No Department Found'));

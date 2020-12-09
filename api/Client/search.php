<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Client.php';

  $database = new Database();
  $db = $database->connect();

  $client = new Client($db);
  $client->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();
  $result = $client->search();
  $num = $result->rowCount();
  $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
  if($num > 0) echo json_encode($rows);
  else echo json_encode(array('message' => 'No Client Found'));

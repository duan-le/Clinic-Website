<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Calendar.php';

  $database = new Database();
  $db = $database->connect();
	$calendar = new Calendar($db);

	$calendar->year = isset($_GET['year']) ? $_GET['year'] : die();
	$result = $calendar->search();
  $num = $result->rowCount();
  $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
  if($num > 0) echo json_encode($rows);
  else echo json_encode(array('message' => 'No Calendar Found'));

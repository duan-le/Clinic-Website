<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/Department.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$department = new Department($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$department->dnumber = $data->dnumber;
$department->type = $data->type;

// Create Category
if ($department->update()) {
  echo json_encode(
    array('message' => 'Department Updated')
  );
} else {
  echo json_encode(
    array('message' => 'Department Not Updated')
  );
}

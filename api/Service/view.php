<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Service.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $service = new Service($db);

  // Category read query
  $result = $service->view();

  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $service_arr = array();
        $service_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $service_item = array(
            'name' => $name,
            'price' => $price
          );

          // Push to "data"
          array_push($service_arr['data'], $service_item);
        }

        // Turn to JSON & output
        echo json_encode($service_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No services Found')
        );
  }
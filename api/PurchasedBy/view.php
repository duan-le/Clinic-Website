<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/PurchasedBy.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $pb = new PurchasedBy($db);

  // Category read query
  $result = $pb->view();

  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $pb_arr = array();
        $pb_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $pb_item = array(
            'product_id' => product_id,
            'user_id' => user_id
          );

          // Push to "data"
          array_push($pb_arr['data'], $pb_item);
        }

        // Turn to JSON & output
        echo json_encode($pb_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Purchases Found')
        );
  }

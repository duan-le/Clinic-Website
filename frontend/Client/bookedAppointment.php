<?php
    include_once '../../config/Database.php';
    include_once '../../model/appointment.php';
    
    $database = new Database();
    $db = $database->connect();
    
    $appointment = new Appointment($db);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $get = $_POST['datetime'];
      $date = explode("-", $get);
      $time = explode("T", $date[2]);
      
      $appointment->day = $time[0];
      $appointment->month = $date[1];
      $appointment->year = $date[0];
      $appointment->time = $time[1];
      $appointment->client_id = $_POST['client_id'];
      $appointment->employee_id = $_POST['therapist'];
      $appointment->service_name = $_POST['service'];

      $appointment->insert();
    }
?>
<!DOCTYPE html>
<html>

<head>
  <style>
      body {background-color: powderblue;}
      h1   {color: blue;}
  </style>
  <title>Massage Clinic</title>
  <meta charset="utf-8">
</head>

<body>
  <h1>Appointment booked</h1>
  <button onclick="location.href = 'home.php';">Return to homepage</button>
  </body>

  </html>
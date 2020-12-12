<?php
    include_once '../../config/Database.php';
    include_once '../../model/Client.php';
    
    $database = new Database();
    $db = $database->connect();
    
    $client = new Client($db);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $client->first_name = $_POST['fname'];
      $client->last_name = $_POST['lname'];
      $client->password = $_POST['password'];
      $client->birthdate = $_POST['date'];
      $client->address = $_POST['address'];
      $client->phone_number = $_POST['phone'];
      $client->sex = $_POST['sex'];

      $client->insert();
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
  <h1>Client created</h1>
  <button onclick="location.href = '../home.php';">Return to homepage</button>
  </body>

</html>
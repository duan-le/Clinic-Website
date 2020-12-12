<!DOCTYPE html>
<html>

<head>
  <title>Services</title>
  <meta charset="utf-8">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />

  <!-- Montserrat font -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />

  <!-- My CSS -->
  <link rel="stylesheet" href="../style.css" />

</head>

<body>
  <nav class="navbar fixed-top navbar-expand-sm navbar-light bg-white">
    <div class="container">
      <a class="navbar-brand" href="home.php">Massage Clinic</a>

      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-menu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar-collapse-menu">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="viewAppointment.php">Appointments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.php">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="seeServices.php">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <main>
    <?php
    session_start();

    include_once '../../config/Database.php';
    include_once '../../model/Appointment.php';

    if (
      isset($_SESSION['user_id'])
      && isset($_SESSION['user_type'])
      && $_SESSION['user_type'] == 'client'
    ) {
      $database = new Database();
      $db = $database->connect();
      $appointment = new Appointment($db);

      $appointment->client_id = $_SESSION['user_id'];
      $result = $appointment->clientsearch();
      $num = $result->rowCount();
      $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
    } else if (
      isset($_SESSION['user_id'])
      && isset($_SESSION['user_type'])
      && $_SESSION['user_type'] == 'employee'
    ) {
      $database = new Database();
      $db = $database->connect();
      $appointment = new Appointment($db);

      $appointment->employee_id = $_SESSION['user_id'];
      $result = $appointment->employeesearch();
      $num = $result->rowCount();
      $rows = $result->fetchAll(\PDO::FETCH_ASSOC);
    } else {
    }

    ?>
    <section id="service-form">
      <div class="container">
        <div class="row">
          <div class="col">
            <h2><b>Appointments</b></h2>
            <!-- Getting info from db using foreach loop -->
            <table>
              <tr>
                <th> Appointment ID </th>
                <th> Day </th>
                <th> Month </th>
                <th> Year </th>
                <th> Time </th>
                <th> Client ID </th>
                <th> Service </th>
              </tr>
              <?php foreach ($rows as $row) : ?>
                <tr>
                  <td> <?php echo $row['appoint_id']; ?> </td>
                  <td> <?php echo $row['day']; ?> </td>
                  <td> <?php echo $row['month']; ?> </td>
                  <td> <?php echo $row['year']; ?> </td>
                  <td> <?php echo $row['time']; ?> </td>
                  <td> <?php echo $row['client_id']; ?> </td>
                  <td> <?php echo $row['service_name']; ?> </td>
                </tr>
              <?php endforeach ?>
            </table>
          </div>
        </div>
      </div>
      <section>
  </main>

</body>

</html>
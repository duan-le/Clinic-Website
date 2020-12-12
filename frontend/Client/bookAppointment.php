<?php
include_once '../../config/Database.php';
include_once '../../model/appointment.php';

$database = new Database();
$db = $database->connect();

$appointment = new Appointment($db);
$result = $appointment->view();

$num = $result->rowCount();
$articles = $result->fetchAll(\PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>

<head>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />

  <!-- Montserrat font -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />

  <!-- My CSS -->
  <link rel="stylesheet" href="../style.css" />
  <title>Appointment</title>
  <meta charset="utf-8">
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
            <a class="nav-link" href="bookAppointment.php">Appointments</a>
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
            <h2><b>Your Appointments</b></h2>
            <!-- Getting info from db using foreach loop -->
            <table>
              <tr>
                <th> Appointment ID </th>
                <th> Day </th>
                <th> Month </th>
                <th> Year </th>
                <th> Time </th>
                <th> Employee ID </th>
                <th> Service </th>
              </tr>
              <?php foreach ($rows as $row) : ?>
                <tr>
                  <td> <?php echo $row['appoint_id']; ?> </td>
                  <td> <?php echo $row['day']; ?> </td>
                  <td> <?php echo $row['month']; ?> </td>
                  <td> <?php echo $row['year']; ?> </td>
                  <td> <?php echo $row['time']; ?> </td>
                  <td> <?php echo $row['employee_id']; ?> </td>
                  <td> <?php echo $row['service_name']; ?> </td>
                </tr>
              <?php endforeach ?>
            </table>
          </div>
        </div>
      </div>
      <section>
    <section id="appointform">
      <div class="container">
        <div class="row">
          <div class="col">
            <fieldset>
              <h2><b>Book An Appointment</b></h2>
              <form method="post" action="bookedAppointment.php">
                <div>
                  Client ID: <input type="number" name="client_id" placeholder="Required" required>
                </div>
                <br />
                <div>
                  First Name: <input type="text" name="fname" placeholder="Required" required>
                </div>
                <br />
                <div>
                  Last Name: <input type="text" name="lname" placeholder="Required" required>
                </div>
                <br />
                <div>
                  Time: <input type="datetime-local" name="datetime" required>
                </div>
                <br />
                <div>
                  <select name="therapist" required>
                    <option value="0">Choose therapist</option>
                    <optgroup label="Male">
                      <option value="1">Jack Jacks</option>
                    </optgroup>
                    <optgroup label="Female">
                      <option value="2">Jill Jills</option>
                    </optgroup>
                  </select>
                </div>
                <br />
                <div>
                  <select name="service" required>
                    <option value="choose">Choose service</option>
                    <option value="Accupuncture">Accupuncture</option>
                    <option value="Cupping Therapy">Cupping Therapy</option>
                    <option value="Hotstone Massage">Hotstone Massage</option>
                    <option value="Reflexology">Reflexology</option>
                  </select>
                </div>
                <br />
                <div>
                  <fieldset>
                    <br>
                  <h2><b>Health Screening</b></h2>
                    <input type="checkbox" name="screen[]" value="contact" id="contact_covid">
                    <label for="contact_covid">I have NOT come in contact with someone with COVID in the last 14 days</label><br>
                    <input type="checkbox" name="screen[]" value="test" id="test_covid">
                    <label for="test_covid">I am NOT currently awaiting the results for a COVID test</label><br>
                    <input type="checkbox" name="screen[]" value="familytest" id="familytest_covid">
                    <label for="familytest_covid">My family / roommates are NOT currently awaiting the results for a COVID test</label><br>
                  </fieldset>
                </div>
                <div>
                  <br><input type="checkbox" name="type" value="yes"> I agree to arrive on time to my appointment
                </div>
                <br />
                <button onClick="window.location.reload();">Book</button>
              </form>
            </fieldset>

          </div>
        </div>
      </div>
    </section>

  </main>

</body>

</html>
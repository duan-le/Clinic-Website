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
  <link rel="stylesheet" href="style.css" />
  <title>Appointment</title>
  <meta charset="utf-8">
</head>

<body>
  <nav class="navbar fixed-top navbar-expand-sm navbar-light bg-white">
    <div class="container">
      <a class="navbar-brand" href="../home.php">Massage Clinic</a>

      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-menu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar-collapse-menu">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="createClient.php">Client</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="bookAppointment.php">Appointments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.php">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="seeServices.php">Services</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <main>
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
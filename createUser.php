<html>
<style>
  .error {
    color: #FF0000;
  }
</style>
<title>Create a new User</title>
<link rel="stylesheet" href="navbar.css">

<body>


  <?php include('navbar.php'); ?>
  <div class="main2">
  </div>
  <?php
  // Default error values init
  $usrnameerr = $emailerr = $passworderr = $usernameerr = "";
  // Default values for contact details
  $birthDate = $roleId = $about = $usrname1 = $passwordUser = $email1 = $username1 = "";
  //Error counter
  $errorCounter = 0;
  // Init the config file where the connection strings are stored
  require_once("config.php");
  // Data Sanitization
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  // Check if data was sent through the form
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Checks if the usrname field was input
    if (empty($_POST["usrname"])) {
      // Error displayed if username is not input
      $usrnameerr = "Username is mandatory.";
      // If error occured increment error counter
      $errorCounter = 1;
    } else {
      $usrname1 = test_input($_POST["usrname"]);
      // preg_match user in order to check if only letters were used in the username field
      if (!preg_match("/^[a-zA-Z ]*$/", $usrname1)) {
        $usrnameerr = "Only letters are allowed.";
        $errorCounter = 1;
      }
    }

    if (empty($_POST["email"])) {
      $emailerr = "The e-mail address is mandatory.";
      $errorCounter = 1;
    } else {
      $email1 = test_input($_POST["email"]);
      // validation of email formatfilter_var
      if (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
        $emailerr = "The e-mail format is invalid.";
        $errorCounter = 1;
      }
    }
    if (empty($_POST["username"])) {
      $usernameerr = "The name is mandatory.";
      $errorCounter = 1;
    } else {
      $username1 = test_input($_POST["username"]);
      if (!preg_match("/^[a-zA-Z0-9 ]*$/", $username1)) {
        $usernameerr = "Only letters, numbers and spaces are allowed.";
        $errorCounter = 1;
      }
    }

    if (empty($_POST["usrPassworda"])) {
      $passworderr = "Password field is mandatory.";
      $errorCounter = 1;
    } else {
      if (empty($_POST["usrPasswordb"])) {
        $passworderr = "Password field is mandatory.";
        $errorCounter = 1;
      } else {
        // Checking if password fields match
        if ($_POST["usrPassworda"] != $_POST["usrPasswordb"]) {
          $passworderr = "The passwords don't match.";
          $errorCounter = 1;
        }
      }
    }

    // If the error counter is == 0 check if the username or e-mail address exists.

    if ($errorCounter == 0) {
      require_once("config.php");

      $db = mysqli_connect($servername, $username, $password, $db_name) or die("could not connect");

      $query = "SELECT * FROM $tbl_name_users WHERE username='$username1'";
      $result = mysqli_query($db, $query);
      $num = mysqli_num_rows($result);
      if ($num == 1) {
        $usernameerr = "The selected username already exists.";
        $errorCounter = 1;
      }
      $query = "SELECT * FROM $tbl_name_users WHERE email='$email1'";
      $result = mysqli_query($db, $query);
      $num = mysqli_num_rows($result);
      if ($num == 1) {
        $emailerr = "The e-mail address is already in use.";
        $errorCounter = 1;
      }
    }

    if ($errorCounter == 0) {
      require_once("config.php");

      // Connect to database
      $db = mysqli_connect($servername, $username, $password, $db_name) or die("could not connect");
      // Increment the highest id that exists in db
      $query = "SELECT MAX(id) AS max FROM $tbl_name_users";
      $result = mysqli_query($db, $query);
      $result2 = mysqli_fetch_array($result);
      $idnew = $result2['max'] + 1;
      // Sanatise user password
      $usrPassword1 = test_input($_POST["usrPassworda"]);
      // Sanitization of about
      $about1 = test_input($_POST["about"]);
      // Sanitization of name
      $usrname1 = test_input($_POST["usrname"]);
      // Sanitization of birth date
      $birthDate = test_input($_POST["birthDate"]);
      // Encrypt password with md5
      $usrPassword1 = md5($usrPassword1);

      // Querry and insertion in database (modified default role id to one, FRESHMAN)

      $query = "INSERT INTO $tbl_name_users (id, name, birth_date, username, email, password, role_id, about) VALUES ('$idnew', '$usrname1', '$birthDate', '$username1', '$email1', '$usrPassword1', '1','$about1')";
      $result = mysqli_query($db, $query);

      // Page where the user is redirected after complete
      header("Location: index.php");
    }
  }
  ?>
  <h2>Register a new user</h2>
  <p><span class="error">* Mandatory field</span></p>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" target="_self" enctype="multipart/form-data">
    <fieldset>
      <legend>Personal user informations</legend>
      <br>
      Name of the User: <br><input type="text" name="usrname" value="<?php echo $usrname1; ?>" lenght="80">
      <span class="error">* <?php echo $usrnameerr; ?></span><br><br>
      E-mail: <br><input type="text" name="email" value="<?php echo $email1; ?>" lenght="80">
      <span class="error">* <?php echo $emailerr; ?></span><br><br>
      Birth Date: <br><input type="date" name="birthDate" min="1900-01-01" value="<?php echo $birthDate; ?>" lenght=80">
      <br> <br>
      About: <br><input type="text" name="about" value="<?php echo $about; ?>" lenght="240">
      <br>

    </fieldset>
    <br>

    <br>
    <fieldset>
      <legend>Login Details</legend>
      <br>
      Username: <br><input type="text" name="username" value="<?php echo $username1; ?>" lenght="40">
      <span class="error">* <?php echo $usernameerr; ?></span><br><br>
      Password: <br><input type="password" name="usrPassworda" lenght="40">
      <br><br>
      Repeat Password: <br><input type="password" name="usrPasswordb" lenght="40">
      <span class="error">* <?php echo $passworderr; ?></span><br>
    </fieldset>
    <br>
    <input type="submit" name="submit" value="Submit">
  </form>
  <br><br>
  <a href='index.php' target='_self'>Home Page</a>
  &nbsp; | &nbsp;
  <a href='login.php' target='_self'>Login</a>
</body>

</html>
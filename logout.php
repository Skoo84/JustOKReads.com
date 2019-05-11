<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>logout</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf8-unicode-ci"/>
</head>
<body>
<div class="main2">


<?php include('navbar.php'); ?>
<?php

require_once("config.php");
$db = new mysqli($servername, $username, $password, $db_name);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// END of connection to DB

// If no first_name variable exists, redirect the user.
if (!isset($_SESSION['name'])) {
    // Start defining the URL.
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    // Check for a trailing slash.
    if ((substr($url, -1) == '/') OR (substr($url, -1) == '\\') ) {
        $url = substr ($url, 0, -1); // Chop off the slash.
    }

    ob_end_clean(); // Delete the buffer.
    exit(); // Quit the script.



} else { // Logout the user.

    $db = new mysqli($servername, $username, $password, $db_name);

// Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

// END of connection to DB

    $usid=$_SESSION['user_id'];
    $query2= "UPDATE users SET online='0' WHERE user_id=$usid";
    $result2 = mysqli_query($db, $query2) or trigger_error("Error" );
    $db->close();
    $_SESSION = array(); // Destroy the variables.
    session_destroy(); // Destroy the session itself.
    setcookie (session_name(), '', time()-300, '/', '', 0); // Destroy the cookie.
}

// Print a customized message.
echo "<h3>Ati fost delogat cu succes.</h3>";
?>

</div>
</body>
</html>


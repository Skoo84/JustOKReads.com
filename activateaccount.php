
<?php # Script 13.7 - activate.php
// This page activates the user's account.
require_once("config.php");



// Set the page title and include the HTML header.
$page_title = 'Activate Your Account';

// Validate $_GET['x'] and $_GET['y'].
if (isset($_GET['x'])) {
    $x = (int) $_GET['x'];
} else {
    $x = 0;
}
if (isset($_GET['y'])) {
    $y = $_GET['y'];
} else {
    $y = 0;
}

// If $x and $y aren't correct, redirect the user.
if ( ($x > 0) && (strlen($y) == 32)) {

    $db = new mysqli($servername, $username, $password, $db_name);

// Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

// END of connection to DB
    $query = "UPDATE users SET active=NULL WHERE (user_id=$x AND active='" . escape_data($y) . "') LIMIT 1";
    $result = mysqli::query ($query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysqli::$error ());

    // Print a customized message.
    if (mysqli::$affected_rows() == 1) {
        echo "<h3>Your account is now active. You may now log in.</h3>";
    } else {
        echo '<pcolor="red" size="+1">Your account could not be activated. Please re-check the link or contact the system administrator.</p>';
    }
    $db->close();

} else { // Redirect.

    // Start defining the URL.
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    // Check for a trailing slash.
    if ((substr($url, -1) == '/') OR (substr($url, -1) == '\\') ) {
        $url = substr ($url, 0, -1); // Chop off the slash.
    }
    // Add the page.
    $url .= '/index.php';

    ob_end_clean(); // Delete the buffer.
    header("Location: $url");
    exit(); // Quit the script.
} // End of main IF-ELSE.

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>change password</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8-unicode-ci"/>

</head>
<body>
<div class="main">

<?php
// This page allows a logged-in user to change their password.
require_once("config.php");
$db = new mysqli($servername, $username, $password, $db_name);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// END of connection to DB
// Set the page title
$page_title = 'change password';

// If no user_name variable exists, redirect the user.
if (!isset($_SESSION['user_name'])) {

    // Start defining the URL.
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    // Check for a trailing slash.
    if ((substr($url, -1) == '/') OR (substr($url, -1) == '\\')) {
        $url = substr($url, 0, -1); // Chop off the slash.
    }
    ob_end_clean(); // Delete the buffer.

    exit(); // Quit the script.

} else {

    if (isset($_POST['submitted'])) { // Handle the form.

        require_once("connection.php"); // Connect to the database.

        // Check for a new password and match against the confirmed password.
        if (preg_match('^[[:alnum:]]{4,20}$', stripslashes(trim($_POST['password1'])))) {
            if ($_POST['password1'] == $_POST['password2']) {
                $p = escape_data($_POST['password1']);
            } else {
                $p = FALSE;
                echo '<p color="red" size="+1">Parola confirmata nu coincide cu cea furnizata in primul camp! Atentie la rescrierea parolei!</p>';
            }
        } else {
            $p = FALSE;
            echo '<p color="red" size="+1">Va rugam sa introduceti o parola valida!</p>';
        }

        if ($p) { // If everything's OK.

            // Make the query.
            $query = "UPDATE users SET pass=SHA('$p') WHERE user_id={$_SESSION['user_id']}";
            $result = mysqli_query($db, $query) or trigger_error("Error in updating pass" );
            if ($result->num_rows > 0) { // If it ran OK.
                // Send an email, if desired.
                echo '<h3>Your password has been changed.</h3>';
                $db->close(); // Close the database connection.
                exit();

            } else { // If it did not run OK.

                // Send a message to the error log, if desired.
                echo '<p color="red" size="+1">Parola dvs nu a putut fi schimbata.</p>';

            }
        } else { // Failed the validation test.
            echo '<p color="red" size="+1">Va rugam sa incercati din nou.</p>';
        }

        $db->close(); // Close the database connection.

    } // End of the main Submit conditional.
    ?>

    <h2>Schimbare parola</h2>
    <form action="change_password.php" method="post">
        <fieldset>
            <p><b>Noua parola:</b> <input type="password" name="password1" size="20" maxlength="32"/>
                <small>Folositi numai litere si cifre. Lungimea parolei trebuie sa fie cuprinsa intre 8 si 32 de
                    caractere.
                </small>
            </p>
            <p><b>Confirmati noua parola:</b> <input type="password" name="password2" size="20" maxlength="20"/></p>
        </fieldset>
        <div align="center"><input type="submit" name="submit" value="Schimba parola"/></div>
        <input type="hidden" name="submitted" value="TRUE"/>
    </form>

    <?php
}
?>
</div>

</body>
</html>

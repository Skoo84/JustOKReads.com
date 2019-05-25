<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>edit user profile</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8-unicode-ci" />
</head>

<body>
    <?php include('navbar.php'); ?>

    <?php
    // This page edits a user.
    // This page is accessed through userprofile.php

    $page_title = 'edit user profile';

    // Check for a valid user ID, through GET or POST.
    if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) { // Accessed through userprofile.php
        $id = $_GET['id'];
    } elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) { // Form has been submitted.
        $id = $_POST['id'];
    } else { // No valid ID, kill the script.
        echo '<h1 id="mainhead">Page Error</h1>
	<p class="error">Page Error</p><p><br /><br /></p>';
        exit();
    }

    require_once("config.php");
    $db = new mysqli($servername, $username, $password, $db_name);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // END of connection to DB

    // Check if the form has been submitted.
    if (isset($_POST['submitted'])) {
        $errors = array(); // Initialize error array.

        // Check for the username.
        if (empty($_POST['username'])) {
            $errors[] = 'You forgot to enter your user name.';
        } else {
            $un = escape_data($_POST['username']);
        }

        // Check for an email address.
        if (empty($_POST['email'])) {
            $errors[] = 'You forgot to enter your email address.';
        } else {
            $e = escape_data($_POST['email']);
        }

        if (empty($errors)) { // If everything's OK.

            //  Test for unique email address.
            $query = "SELECT user_id FROM users WHERE email='$e' AND user_id != $id";
            $result = mysqli_query($db, $query);

            if ($result->num_rows == 0) {
                // Make the query.
                $query = "UPDATE users SET username='$un', email='$e' WHERE user_id=$id";
                $result = mysqli_query($db, $query); // Run the query.

                if ($result->num_rows == 1) { // If it ran OK.
                    // Print a message.
                    echo '<h1 id="mainhead">Editare utilizator</h1>
				<p>Utilizatorul a fost actualizat.</p><p><br /><br /></p>';
                } else if ($result->num_rows == 0) { //nu s-a actualizat nimic
                    echo '<h1 id="mainhead">Editare utilizator</h1>
				<p>Nu s-a efectuat nici o actualizare asupra datelor utilizatorului.</p><p><br /><br /></p>';
                } else { // If it did not run OK.
                    echo '<h1 id="mainhead">System Error</h1>
				<p class="error">The user could not be edited.</p>'; // Public message.
                    echo 'Error'; // Debugging message.
                    exit();
                }
            } else { // Already registered.
                echo '<h1 id="mainhead">Error!</h1>
			<p class="error">The email address has already been registered.</p>';
            }
        } else { // Report the errors.
            echo '<h1 id="mainhead">Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
            foreach ($errors as $msg) { // Print each error.
                echo " - $msg<br />\n";
            }
            echo '</p><p>Please try again.</p><p><br /></p>';
        } // End of if (empty($errors)) IF.

    } // End of submit conditional.

    // Retrieve the user's information.
    $query = "SELECT name, email FROM users WHERE user_id=$id";
    $result = mysqli_query($db, $query); // Run the query.

    if ($result->num_rows == 1) { // Valid user ID, show the form.
        // Get the user's information.
        $row = $result->fetch_assoc();

        // Create the form.
        echo '<h2>Editare date utilizator</h2>
<form action="edituser.php" method="post">
<p>Nume: <input type="text" name="name" size="15" maxlength="50" value="' . $row[0] . '" /></p>
<p>Email: <input type="text" name="email" size="25" maxlength="30" value="' . $row[1] . '"  /> </p>
<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="submitted" value="TRUE" />
<input type="hidden" name="id" value="' . $id . '" />
</form>';
    } else { // Not a valid user ID.
        echo '<h1 id="mainhead">Page Error</h1>
	<p class="error">Error on page.</p><p><br /><br /></p>';
    }

    $db->close(); // Close the database connection.

    ?>
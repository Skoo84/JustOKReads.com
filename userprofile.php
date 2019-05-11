<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $name; ?>'s Profile </title>
<!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">-->
<!--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf8-unicode-ci"/>
    <link rel="stylesheet" href="navbar.css">

    <style>
.border-success
    </style>
</head>
<body>
<div class="main1">
</div>
<h1>The User Profile page in construction </h1>
<div style="margin-bottom: 20px;">
    <a href=""> Edit User Profile</a><br>
</div>

<div class="card text-white bg-success mb-3" style="max-width: 20rem; float: left;">
    <?php
    require_once("config.php");
    $db = new mysqli($servername, $username, $password, $db_name);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $query = "SELECT * FROM users ";
    $result = mysqli_query($db, $query);

    if ($result->num_rows > 0) {
        if($row = $result->fetch_assoc()) {

            echo "<div class=\"card-header\">Hello, " . $row['name'] . '</br></div>';
            echo "<h4 class=\"card-title\">Personal informations: " . '</h4>';
            echo '<table>';
            echo '<tr><td>Name:</td><td>' . $row["username"] . '</td></tr>';
            echo '<tr><td>Birth date:</td><td>' . $row["birth_date"] . '</td></tr>';
            echo '<tr><td>Email:</td><td>' . $row["email"] . '</td></tr>';
            echo '<tr><td>Description:</td><td>' . $row["about"] . '</td></tr>';
            //  echo '</table>';
            '</br>';
            //   echo '<table>';
            //   echo '<tr><td>Reviews:</td><td>' . $row["description"] . '</td></tr>';
            //   echo '<tr><td>Rating:</td><td>' . $row["rating"] . '</td></tr>';
        }
        echo '</table>';
    } else {
        echo "0 results";
    }
    ?>
</div>

<div class="card border-success mb-3" style="max-width: 20rem; float: left;">
    <?php
    require_once("config.php");
    $db = new mysqli($servername, $username, $password, $db_name);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    $query1 = "SELECT rw.description, rw.rating, rw.title    
    FROM reviews rw
    JOIN users u ON rw.user_id = u.id";

    $result1 = mysqli_query($db, $query1);
    if ($result1->num_rows > 0) {
         if ($row = $result1->fetch_assoc()) {
            echo "<div class=\"card-header\">Book: " . $row['title'] . '</br></div>';
            echo '<table>';
            echo '<tr><td><div class="card-header">Rating:</td><td>' . $row["rating"] . '</div></td></tr>';
            echo '<tr><td><div class="card-body">Description:</td><td>' . $row["description"] . '</div></td></tr>';
            //  echo '</table>';
            '</br>';
            //   echo '<table>';
            //   echo '<tr><td>Reviews:</td><td>' . $row["description"] . '</td></tr>';
            //   echo '<tr><td>Rating:</td><td>' . $row["rating"] . '</td></tr>';
        }
        echo '</table>';
    } else {
        echo "0 results";
    }
    $db->close();
    ?>
</div>

</body>
</html>

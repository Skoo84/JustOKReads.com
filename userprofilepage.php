<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $name; ?>'s Profile </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8-unicode-ci"/>
</head>
<body>
<div>
<?php
// get the user details from data base
if (isset($_GET['userid'])) {
    require_once("config.php");
    $db = new mysqli($servername, $username, $password, $db_name);

// Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

// END of connection to DB
    $idUser = $_GET['userid'];

    $sql = "SELECT * FROM $tbl_name_users WHERE id = '$idUser'";
    $result = mysqli_query($db, $sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<h3>Hello, " . $row['name'] . '</br></h3>';
            echo '<table>';
            echo '<tr><td>Name:</td><td>' . $row["username"] . '</td></tr>';
            echo '<tr><td>Birth date:</td><td>' . $row["birth_date"] . '</td></tr>';
            echo '<tr><td>Email:</td><td>' . $row["email"] . '</td></tr>';
            echo '<tr><td>Description:</td><td>' . $row["about"] . '</td></tr>';
        }
    }
    $db->close();

// get the user rewiews from data base
    $sql1 = "SELECT rw.description, rw.rating, rw.title
    FROM reviews rw
    JOIN users u ON rw.user_id = u.id
    WHERE u.id = '$idUser'";
    $result1 = mysqli_query($db, $sql1);
    if ($result1->num_rows > 0) {
        if ($row = $result1->fetch_assoc()) {
            echo '<table>';
            echo '<tr><td>Book:</td><td>' . $row["title"] . '</td></tr>';
            echo '<tr><td>Rating:</td><td>' . $row["rating"] . '</td></tr>';
            echo '<tr><td>Description:</td><td>' . $row["description"] . '</td></tr>';
            '</br>';
        }
        echo '</table>';
    } else {
        echo "0 results";
    }
    $db->close();
}
?>

</div>
</body>
</html>
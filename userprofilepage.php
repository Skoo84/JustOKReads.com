<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('navbar.php'); ?>
    <title><?php echo $_SESSION['Username'] ?>'s Profile</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8-unicode-ci" />
    <link rel="stylesheet" href="navbar.css">
</head>

<body>
    <div class="main2"></div>
    <div>
        <?php

        // get the user details from data base
        if (isset($_SESSION['UserID'])) {
            echo '<h1>Welcome <?php echo ' . $_SESSION['Username'] . '?></h1>';
            require_once("config.php");
            $db = new mysqli($servername, $username, $password, $db_name);
            // Check connection
            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }

            // END of connection to DB
            $idUser = $_SESSION['UserID'];

            $sql = "SELECT * FROM $tbl_name_users WHERE id = '$idUser'";
            $result = mysqli_query($db, $sql);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo '<table>';
                    echo '<tr>
                <td>Name:</td>
                <td>' . $row["username"] . '</td>
            </tr>';
                    echo '<tr>
                    <td></td>
                <td><img src=' . $row["username"] .'>" </td>
                

            </tr>';
                    echo '<tr>
                <td>Birth date:</td>
                <td>' . $row["birth_date"] . '</td>
            </tr>';
                    echo '<tr>
                <td>Email:</td>
                <td>' . $row["email"] . '</td>
            </tr>';
                    echo '<tr>
                <td>Description:</td>
                <td>' . $row["about"] . '</td>
            </tr>';
                }
            }
            // $db->close(); Nu uita sa nu inchizi conexiuni cat timp mai ai nevoie de ele @Iulia.

            // get the user rewiews from data base
            $sql1 = "SELECT rw.description, rw.rating, rw.title
            FROM reviews rw
            JOIN users u ON rw.user_id = u.id
            WHERE u.id = $idUser";
            $result1 = mysqli_query($db, $sql1);
            if ($result1->num_rows > 0) {
                if ($row = $result1->fetch_assoc()) {
                    echo '<table>';
                    echo '<tr>
                    <td>Book:</td>
                    <td>' . $row["title"] . '</td>
                </tr>';
                    echo '<tr>
                    <td>Rating:</td>
                    <td>' . $row["rating"] . '</td>
                </tr>';
                    echo '<tr>
                    <td>Description:</td>
                    <td>' . $row["description"] . '</td>
                </tr>';
                    '</br>';
                    echo '</table>';
                }
            } else {
                echo '<p>';
                echo "There aren't any reviews to be displayed.";
                echo '</p>';
            }
            $db->close();
        } else {
            echo "<h1>In order to see the User Profile page, you have be logged in.</h1>";
            echo "<a href='login.php' target='_self'>Login</a>";
        }
        ?>

    </div>
</body>

</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Book</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8-unicode-ci" />
    <link rel="stylesheet" href="navbar.css">

<body>
    <div class="main2"></div>
    <?php include('navbar.php'); ?>
    <div style="padding-left: 15px;">
     <?php   
     require_once('config.php');
    $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
    $idRole = $_SESSION['RoleId'];
    $idBook = $_GET['bookid'];
    $query;
    if($idRole == 1 ||$idRole == 2 || $idRole == 7 || $idRole == 8 || $idRole == 9){
        $query = "SELECT rw.description, rw.rating, rw.title, u.name
        FROM reviews rw
        JOIN users u ON rw.user_id = u.id";
    }else if($idRole == 3 || $idRole == 4 || $idRole == 5 || $idRole == 6){
        $query = "SELECT rw.description, rw.rating, rw.title, u.name
        FROM reviews rw
        JOIN users u ON rw.user_id = u.id
        WHERE rw.book_id = $idBook
        order by rw.rating desc";
    }

    $result = mysqli_query($db, $query);
    echo "<p align='left'> Reviews: </p>
    <p>Click on review title to edit review and click on delete to delete the review</p>";
    if($result->num_rows > 0){
      echo "<table style='border:1px solid black; border-collapse:collapse;'>
        <tr><td style='border:1px solid black;'>Reviewer Name</td>
        <td style='border:1px solid black;'>Title</td>
        <td style='border:1px solid black;'>Description</td>
        <td style='border:1px solid black;'>Ratings</td>
        <td></td>";
      while($r = mysqli_fetch_array($result)){
        echo "<tr> <td style='border:1px solid black;'>" .  $r['name'] .
          "</td><td style='border:1px solid black;'><a href='editview.php?bookid=$idBook&title=$r[title]'>" .  $r['title'] . "</a>" . 
         "</td><td style='border:1px solid black;'>" . $r['description'] .
         "</td><td style='border:1px solid black;'>" . $r['rating'] . "</td>
         <td style='border:1px solid black;'><a href='delete.php?bookid=$idBook&title=$r[title]'>Delete</a></td></tr>";
      }
      echo "<br>";
      echo "</table>";
    }

    $db->close();
    ?>
    </div>
</body>
</head>
</html>
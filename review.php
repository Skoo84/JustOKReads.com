<?php
require_once ("config.php");

session_start();

$idBook = $_GET['bookid'];
$idUser = $_SESSION['UserID'];
if(isset($_SESSION['UserID'])){
    $posttitle = $_POST['title'];
    $postdescription = $_POST['description'];
    $postratings = $_POST['ratings'];
    echo $posttitle . " " . $postdescription . " " . $postratings;

    $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
    $query = "INSERT INTO reviews(book_id, user_id, title, description, rating) VALUES('$idBook', '$idUser', '$posttitle','$postdescription', '$postratings')";
    mysqli_query($db,$query);
    $db->close();

    header("Location: book.php?bookid=$idBook");
  }

?>
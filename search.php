<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="navbar.css">
</head>
<body>
<?php include('navbar.php'); ?>

<!-- Anchor for footer - return to top of the page -->
<div class="main">
<a name="top"></a>
<h1>This wonderful search page is done. Almost ... ish </h1>






<form action="search.php" method="GET">
    <input type="text" name="query" />
    <input type="submit" value="Search" />
</form>

</div>
<?php
// se verifica daca utilizatorul este autentificat
if (isset($_SESSION['Username']))
  {

require_once ("config.php");
$userName = ($_SESSION['Username']);
echo "<p>The user: ".$userName." is logged in.</p>";


if(isset($_GET['query']))
{


    echo "<p------------------------------------------------p>";
    echo"<h1>|Results for Authors|</h1>";
    echo "<p------------------------------------------------p>";


    $resultFromForm = $_GET['query']; 

    $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
    $query="SELECT * FROM $tbl_name_authors WHERE NAME LIKE '%$resultFromForm%'";
    $result=mysqli_query($db,$query);
    if ($result->num_rows > 0){


    while ($r=mysqli_fetch_array($result)) {
        $authorid=$r['id'];
        $authorname=$r['name'];
        echo "<a align='left' href='author.php?authorid=$authorid'> Name of the Author: ".$authorname."</a> <br />";
        $authorbio=$r['bio'];
        echo "<p align='left'> Bio: ".$authorbio."</p>";
        $authorpic=$r['picture'];
        echo "<img src='".$authorpic."' alt='".$authorname."' style='width:300px;height:200px'>";

        
        echo "<p align='left'> ------------------------------</p>";
      }
    } else {echo "0 results";}

      //Querry for the books

      echo "<p------------------------------------------------p>";
      echo"<h1>|Results for Books|</h1>";
      echo "<p------------------------------------------------p>";


      $query="SELECT b.id, b.title, b.publisher_id, b.release_date, b.cover_photo, b.description, p.name
      FROM books b
      INNER JOIN publishers p ON b.publisher_id=p.id
      WHERE b.title LIKE '%$resultFromForm%'";

      $result=mysqli_query($db,$query);
      if ($result->num_rows > 0){

      while ($r=mysqli_fetch_array($result)) {
          $bookid=$r['id'];
          $booktitle=$r['title'];
          echo "<a align='left' href='book.php?bookid=$bookid'> Title of the Book: ".$booktitle."</a><br />";
          $publisherId=$r['publisher_id'];
          $publisherName=$r['name'];
          echo "<p align='left'> Publisher :".$publisherName."</p> <br />";
          $releaseDate=$r['release_date'];
          $coverPhoto=$r['cover_photo'];
          $description=$r['description'];
          echo "<span align='left'>Release Date : ".$releaseDate.", Description:".$description."</span> <br />";
          echo "<img src='".$coverPhoto."' alt='".$booktitle."' style='width:300px;height:200px'>";
          echo "<p align='left'> ------------------------------</p>";
        }
    } else {echo "0 results";}



    // querry for the publishers


    echo "<p------------------------------------------------p>";
    echo"<h1>|Results for Publishers|</h1>";
    echo "<p------------------------------------------------p>";

    $query="SELECT * FROM publishers WHERE name LIKE '%$resultFromForm%'";
    $result=mysqli_query($db,$query);
    if ($result->num_rows > 0){

    while ($r=mysqli_fetch_array($result)) {
        $publisherid=$r['id'];
        $publishername=$r['name'];
        echo "<p align='left'> Publisher :".$publishername."</p>";
        echo "<p align='left'> ------------------------------</p>";
        echo "<br />";
        echo "<br />";
        echo "<br />";
      }
  } else {echo "0 results";}
  $db->close();

    }
  }

  // daca utilizatorul nu este autentificat
else
{
  echo "<p>You are not logged in, in order to use the search functionality, you have to log in.</p> ";
  echo "<a href='login.php' target='_self'>Login</a>";
  echo "&nbsp; | &nbsp;";
  echo "<a href='createUser.php' target='_self'>Inregistrare utilizator nou</a>";

}
    
?>


</body>
</html>
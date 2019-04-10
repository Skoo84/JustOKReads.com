<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
 
<h1>This wonderful search page is done. Almost ... ish </h1>

<form action="search.php" method="GET">
    <input type="text" name="query" />
    <input type="submit" value="Search" />
</form>

<?php
if(isset($_GET['query']))
{


    echo "<p------------------------------------------------p>";
    echo"<h1>|Results for Authors|</h1>";
    echo "<p------------------------------------------------p>";


    $resultFromForm = $_GET['query']; 
    require_once ("config.php");
    $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
    $query="SELECT * FROM $tbl_name_authors WHERE NAME LIKE '%$resultFromForm%'";
    $result=mysqli_query($db,$query);
    if ($result->num_rows > 0){


    while ($r=mysqli_fetch_array($result)) {
        $authorid=$r['id'];
        $authorname=$r['name'];
        echo "<a align='left' href='http://localhost/JustOKReads.com/author.php?authorid=$authorid'> Name of the Author: ".$authorname."</a> <br />";
        $authorbio=$r['bio'];
        echo "<p align='left'> Bio: ".$authorbio."</p>";
        $authorpic=$r['picture'];
        echo "<p align='left'> Pic: ".$authorpic."</p>";
        echo "<p align='left'> ------------------------------</p>";
      }
    } else {echo "0 results";}

      //Querry for the name of the books

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
          echo "<a align='left' href='http://www.justokreads.com/book.php?id=$bookid'> Title of the Book: ".$booktitle."</a><br />";
          $publisherId=$r['publisher_id'];
          $publisherName=$r['name'];
          echo "<a align='left' href='http://www.justokreads.com/publisher.php?id=$publisherId'> Publisher :".$publisherName."</a> <br />";
          $releaseDate=$r['release_date'];
          $coverPhoto=$r['cover_photo'];
          $description=$r['description'];
          echo "<span align='left'>Release Date : ".$releaseDate.", Cover Photo: ".$coverPhoto.", Description:".$description."</span>";
          echo "<p align='left'> ------------------------------</p>";
        }
    } else {echo "0 results";}
    $db->close();
    }
    
?>
</body>
</html>
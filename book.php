<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Book</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
 

<?php
if(isset($_GET['bookid']))
{
    require_once ("config.php");
    $idBook = $_GET['bookid']; 

    $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
    $query="SELECT * FROM $tbl_name_books WHERE id = '$idBook'";
    $result=mysqli_query($db,$query);
    if ($result->num_rows > 0){


    while ($r=mysqli_fetch_array($result)) {
        $bookid=$r['id'];
        $bookname=$r['title'];
        echo "<p align='left'>  ".$bookname."</p> <br />";
        $releasedate=$r['release_date'];
        echo "<p align='left'> Release date: ".$releasedate."</p>";
        $coverpic=$r['cover_photo'];
        echo "<img src='".$coverpic."' alt='".$bookname."' style='width:300px;height:200px'>";
        echo "<p align='left'> ------------------------------</p>";
      }
    } 
    $db->close();



    $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
    $query="SELECT  b.id, 
    GROUP_CONCAT(a.name ORDER BY a.name) authors
FROM    books b
    INNER JOIN books_authors ba
        ON b.id = ba.book_id 
    INNER JOIn authors a
        ON ba.author_id = a.id
        WHERE b.id='$idbook'
GROUP   BY b.id";
    $result=mysqli_query($db,$query);

    echo "<p align='left'> Written by: ".$result."</p>";

    if ($result->num_rows > 0){
    while ($r=mysqli_fetch_array($result)) {
        
        echo "<p align='left'> Written by: ".$r."</p>";
      
      }
    } else {echo "The Author doesn't exist.";}

}
    $db->close();
    
?>
</body>
</html>
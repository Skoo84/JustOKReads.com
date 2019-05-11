<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="navbar.css">
</head>
<body>
 

<?php include('navbar.php'); ?>
<?php
if(isset($_GET['authorid']))
{
    require_once ("config.php");
    $idAuthor = $_GET['authorid']; 
  
    $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
    $query="SELECT * FROM $tbl_name_authors WHERE id = '$idAuthor'";
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
    } 
    $db->close();



    $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
    $query="SELECT a.id, a.name, a.bio, a.picture, b.id, b.title, b.publisher_id, b.release_date,b.cover_photo,b.description
    FROM authors a
    INNER JOIN books_authors ba ON ba.author_id=a.id AND a.id='$idAuthor'
    INNER JOIN books b ON ba.book_id=b.id";
    $result=mysqli_query($db,$query);

    



    if ($result->num_rows > 0){
    while ($r=mysqli_fetch_array($result)) {
        $publisherid=$r['publisher_id'];
        $bookTitle=$r['title'];
        echo "<p align='left'> Boook Name: ".$bookTitle."</p>";
        $publisherID=$r['publisher_id'];
        echo "<p align='left'> Publisher ID: ".$publisherid."</p>";
        echo "<p align='left'> ------------------------------</p>";
      }
    } else {echo "The Author doesn't exist.";}

}
    $db->close();
    

?>

</body>
</html>
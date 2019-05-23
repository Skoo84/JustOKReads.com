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
    $idBook = $_GET['bookid'];
    $idUser = $_SESSION['UserID'];
    $titleReview = $_GET['title'];
    $r;
    $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
    $query = "SELECT * FROM reviews where title = '$titleReview' and book_id = '$idBook'";
    $result = mysqli_query($db, $query);
    if($result->num_rows > 0){
        $r = mysqli_fetch_array($result);
    }
    $db->close();

    ?>

    <h3>Edit review</h3>
    <form action="edit.php?bookid=<?=$_GET['bookid']?>&title=<?=$titleReview?>" method="post">
  <label for="title">Title: </label>
  <br>
  <input type="text" name="title" value='<?php echo $r["title"]?>'>
  <br>
  <label for="description">Description: </label>
  <br>
  <textarea name="description" cols="30" rows="10"><?php echo $r['description']?></textarea>
  <br>
  <label for="ratings">Ratings: </label>
  <br>
  <select name="ratings">
    <?php 
    if($r['rating'] == 1){
    echo "<option value='1' selected>1</option>";
    }
    else{
      echo "<option value='1'>1</option>";
    }
    if($r['rating'] == 2){
    echo "<option value='2' selected>2</option>";
    }
    else{
      echo "<option value='2'>2</option>";
    }
    if($r['rating'] == 3){
    echo "<option value='3' selected>3</option>";
    }
    else{
      echo "<option value='3'>3</option>";
    }
    if($r['rating'] == 4){
    echo "<option value='4' selected>4</option>";
    }
    else{
      echo "<option value='4'>4</option>";
    }
    if($r['rating'] == 5){
    echo "<option value='5' selected>5</option>";
    }
    else{
      echo "<option value='5'>5</option>";
    }
    ?>
  </select>
  <br>
  <button type="submit">Edit review</button>
</form>

    </div>
</body>
</head>
</html>
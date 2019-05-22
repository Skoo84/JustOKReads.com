<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>Book</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf8-unicode-ci" />
  <link rel="stylesheet" href="navbar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
    .ratings i {
      color: #ff9900;
    }
  </style>


</head>

<body>
  <div class="main2">

  </div>
  <?php include('navbar.php'); ?>
  <div style="padding-left: 15px;">
    <?php

    function star_rating($rating)
    {
      $rating_round = round($rating * 2) / 2;
      if ($rating_round <= 0.5 && $rating_round > 0) {
        return '<i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
      }
      if ($rating_round <= 1 && $rating_round > 0.5) {
        return '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
      }
      if ($rating_round <= 1.5 && $rating_round > 1) {
        return '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
      }
      if ($rating_round <= 2 && $rating_round > 1.5) {
        return '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
      }
      if ($rating_round <= 2.5 && $rating_round > 2) {
        return '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
      }
      if ($rating_round <= 3 && $rating_round > 2.5) {
        return '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
      }
      if ($rating_round <= 3.5 && $rating_round > 3) {
        return '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i>';
      }
      if ($rating_round <= 4 && $rating_round > 3.5) {
        return '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
      }
      if ($rating_round <= 4.5 && $rating_round > 4) {
        return '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>';
      }
      if ($rating_round <= 5 && $rating_round > 4.5) {
        return '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
      }
    }

    if (isset($_GET['bookid'])) {
      require_once("config.php");
      $idBook = $_GET['bookid'];

      $db = mysqli_connect($servername, $username, $password, $db_name) or die("could not connect");
      $query = "SELECT * FROM $tbl_name_books WHERE id = '$idBook'";
      $result = mysqli_query($db, $query);
      if ($result->num_rows > 0) {


        while ($r = mysqli_fetch_array($result)) {
          $bookid = $r['id'];
          $bookname = $r['title'];
          echo "<p align='left'> <b> " . $bookname . "</b></p> <br />";
          $coverpic = $r['cover_photo'];
          echo "<img src='" . $coverpic . "' alt='" . $bookname . "' style='width:300px;height:200px'>";

          $bookdescription = $r['description'];
          echo "<p align='left'>  " . $bookdescription . "</p> <br />";
          $releasedate = $r['release_date'];
          echo "<p align='left'> Release date: " . $releasedate . "</p>";
          $coverpic = $r['cover_photo'];
          echo "<p align='left'> ------------------------------</p>";
        }
      }
      $db->close();

      $db = mysqli_connect($servername, $username, $password, $db_name) or die("could not connect");
      $query = "SELECT r.book_id, avg(r.rating), count(r.rating) FROM reviews r
    where book_id = '$idBook'";
      $result = mysqli_query($db, $query);
      if ($result->num_rows > 0) {


        while ($r = mysqli_fetch_array($result)) {
          $rating = $r['avg(r.rating)'];
          $feedbacks = $r['count(r.rating)'];

          echo "<p align='left'> Rating: " . $rating . "</p>";
          echo "<p align='left'> ------------------------------</p>";
        }
      }
      $db->close();




      $db = mysqli_connect($servername, $username, $password, $db_name) or die("could not connect");

      $query = "SELECT a.id, a.name
    FROM authors a
    JOIN books_authors ba ON a.id = ba.author_id
    JOIN books b ON b.id = ba.book_id
    WHERE b.id = '$idBook'";
      $result = mysqli_query($db, $query);
      echo "<p align='left'> ------------------------------</p>";
      echo "<p align='left'> Written by:</p>";
      if ($result->num_rows > 0) {


        while ($r = mysqli_fetch_array($result)) {
          $authorid = $r['id'];
          $authorname = $r['name'];
          echo "<a align='left' href='http://JustOKReads.com/author.php?authorid=$authorid'>" . $authorname . "</a> <br />";
        }
      }

      $query3 = "SELECT b.id, b.publisher_id, p.name
    FROM books b
    JOIN publishers p ON b.publisher_id = p.id
	
    WHERE b.id = '$idBook'";
      $result = mysqli_query($db, $query3);
      echo "<p align='left'> ------------------------------</p>";
      echo "<p align='left'> Publisher:</p>";
      if ($result->num_rows > 0) {


        while ($r = mysqli_fetch_array($result)) {

          $publishername = $r['name'];
          echo "<a align='left' >" . $publishername . "</a> <br />";
        }
      }



      $db->close();
    }
    ?>
  </div>
</body>
<div class="ratings" style="padding-left: 15px;">
  <p>ratings: <?php echo star_rating($rating); ?> based on <?php echo "$feedbacks"  ?> reviews </p>
</div>

</html>
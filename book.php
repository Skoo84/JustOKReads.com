<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Book</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8-unicode-ci" />
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
        $bookdescription=$r['description'];
        echo "<p align='left'>  ".$bookdescription."</p> <br />";
        $releasedate=$r['release_date'];
        echo "<p align='left'> Release date: ".$releasedate."</p>";
        $coverpic=$r['cover_photo'];
        echo "<img src='".$coverpic."' alt='".$bookname."' style='width:300px;height:200px'>";
        echo "<p align='left'> ------------------------------</p>";
      }
    } 
    $db->close();

    $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
    $query="SELECT r.book_id, avg(r.rating) FROM reviews r
    where book_id = '$idBook'";
    $result=mysqli_query($db,$query);
    if ($result->num_rows > 0){


    while ($r=mysqli_fetch_array($result)) {
        $rating=$r['avg(r.rating)'];
        
        echo "<p align='left'> Rating: ".$rating."</p>";
        echo "<p align='left'> ------------------------------</p>";
      }
    } 
    $db->close();

    
    

    $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
    
    $query="SELECT a.id, a.name
    FROM authors a
    JOIN books_authors ba ON a.id = ba.author_id
    JOIN books b ON b.id = ba.book_id
    WHERE b.id = '$idBook'";
    $result=mysqli_query($db,$query);
    echo "<p align='left'> ------------------------------</p>";
    echo "<p align='left'> Written by:</p>";
    if ($result->num_rows > 0){


    while ($r=mysqli_fetch_array($result)) {
        $authorid=$r['id'];
        $authorname=$r['name'];
        echo "<a align='left' href='http://JustOKReads.com/author.php?authorid=$authorid'>".$authorname."</a> <br />";

      }
    } 
    $db->close();

  } 
?>
<div class="row">
<div class="col-sm-12">
<form id="ratingForm" method="POST">
<div class="form-group">
<h4>Rate this product</h4>
<button type="button" class="btn btn-warning btn-sm rateButton" aria-label="Left Align">
<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
</button>
<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
</button>
<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
</button>
<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
</button>
<button type="button" class="btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
</button>
<input type="hidden" class="form-control" id="rating" name="rating" value="1">
<input type="hidden" class="form-control" id="itemId" name="itemId" value="12345678">
</div>
<div class="form-group">
<label for="usr">Title*</label>
<input type="text" class="form-control" id="title" name="title" required>
</div>
<div class="form-group">
<label for="comment">Comment*</label>
<textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
</div>
<div class="form-group">
<button type="submit" class="btn btn-info" id="saveReview">Save Review</button> <button type="button" class="btn btn-info" id="cancelReview">Cancel</button>
</div>
</form>
</div>
</div>
<div class="row">
<div class="col-sm-7">
<hr/>
<div class="review-block">

<?php
$db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
$ratinguery = "SELECT book_id, user_id, rating, title, description FROM reviews";
while($rating = mysqli_fetch_assoc($ratingResult)){

?>
<div class="row">
<div class="col-sm-3">
<img src="image/profile.png" class="img-rounded">
<div class="review-block-name">By <a href="#">phpzag</a></div>
</div>
<div class="col-sm-9">
<div class="review-block-rate">
<?php
for ($i = 1; $i <= 5; $i++) {
$ratingClass = "btn-default btn-grey";
if($i <= $rating['ratingNumber']) {
$ratingClass = "btn-warning";
}
?>
<button type="button" class="btn btn-xs <?php echo $ratingClass; ?>" aria-label="Left Align">
<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
</button>
<?php } ?>
</div>
<div class="review-block-title"><?php echo $rating['title']; ?></div>
<div class="review-block-description"><?php echo $rating['description']; ?></div>
</div>
</div>
<hr/>
<?php } ?>
</div>
</div>
</div>
</body>
</html>
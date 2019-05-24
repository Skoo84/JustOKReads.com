<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Book</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf8-unicode-ci" /> -->
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="js/rating.js"></script>
  <style type="text/css">
    .ratings i {
      color: #ff9900;
    }
  </style>
  

</head>
<body style="overflow-x: hidden;">
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
        echo "<p align='left'> <b> ".$bookname."</b></p> <br />";
        $coverpic=$r['cover_photo'];
        echo "<img src='".$coverpic."' alt='".$bookname."' style='width:300px'>";

        $bookdescription=preg_replace('/[^A-Za-z0-9ÄäÜüÖöß]/', ' ', $r['description']);
        
        echo "<p align='left'>  ".htmlentities($r['description'], ENT_QUOTES | ENT_IGNORE, "UTF-8")."</p> <br />";
        $releasedate=$r['release_date'];
        echo "<p align='left'> Release date: ".$releasedate."</p>";
        $coverpic=$r['cover_photo'];
        echo "<p align='left'> ------------------------------</p>";
      }
    } 
    $db->close();

    $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
    $query="SELECT r.book_id, avg(r.rating), count(r.rating) FROM reviews r
    where book_id = '$idBook'";
    $result=mysqli_query($db,$query);
    if ($result->num_rows > 0){


    while ($r=mysqli_fetch_array($result)) {
        $rating=$r['avg(r.rating)'];
        $feedbacks=$r['count(r.rating)'];
        
    //     echo "<p align='left'> Rating: ".$rating."</p>";
    //     echo "<p align='left'> ------------------------------</p>";
    //   }
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
    
    $query3="SELECT b.id, b.publisher_id, p.name
    FROM books b
    JOIN publishers p ON b.publisher_id = p.id
	
    WHERE b.id = '$idBook'";
    $result=mysqli_query($db,$query3);
    echo "<p align='left'> ------------------------------</p>";
    echo "<p align='left'> Publisher:</p>";
    if ($result->num_rows > 0){


    while ($r=mysqli_fetch_array($result)) {
       
        $publishername=$r['name'];
        echo "<a align='left' >".$publishername."</a> <br />";

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
  <?php

  if (isset($_GET['bookid'])) {
    
  $bookId = $_GET['bookid'];
  ?>
    <div id="ratingDetails" style="padding-left: 20px;">        
        <div class="row">           
            <div class="col-sm-3">              
                <h4>Rating and Reviews</h4>
                <h2 class="bold padding-bottom-7"><?php printf('%.1f', $rating); ?> <small>/ 5</small></h2>                
                <?php
                $averageRating = round($rating, 0);
                for ($i = 1; $i <= 5; $i++) {
                    $ratingClass = "btn-default btn-grey";
                    if($i <= $averageRating) {
                        $ratingClass = "btn-warning";
                    }
                ?>
                <button type="button" class="btn btn-sm <?php echo $ratingClass; ?>" aria-label="Left Align">
                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                </button>   
                <?php } ?>              
            </div>
            <?php
                $fiveStarRating = 0;
                $fourStarRating  = 0;
                $threeStarRating = 0;
                $twoStarRating = 0;
                $oneStarRating = 0;
                
                $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
                $query="SELECT * FROM reviews WHERE book_id = '$bookId'";
                $result=mysqli_query($db,$query);
                if ($result->num_rows > 0){
                    while ($r=mysqli_fetch_array($result)) {
                        if($r['rating'] == 5) {
            $fiveStarRating +=1;
        } else if($r['rating'] == 4) {
            $fourStarRating +=1;
        } else if($r['rating'] == 3) {
            $threeStarRating +=1;
        } else if($r['rating'] == 2) {
            $twoStarRating +=1;
        } else if($r['rating'] == 1) {
            $oneStarRating +=1;
        }
                     }
                 }
    
            ?>
            <div class="col-sm-3">
                <?php
                $fiveStarRatingPercent = round(($fiveStarRating/5)*100);
                $fiveStarRatingPercent = !empty($fiveStarRatingPercent)?$fiveStarRatingPercent.'%':'0%';    
                
                $fourStarRatingPercent = round(($fourStarRating/5)*100);
                $fourStarRatingPercent = !empty($fourStarRatingPercent)?$fourStarRatingPercent.'%':'0%';
                
                $threeStarRatingPercent = round(($threeStarRating/5)*100);
                $threeStarRatingPercent = !empty($threeStarRatingPercent)?$threeStarRatingPercent.'%':'0%';
                
                $twoStarRatingPercent = round(($twoStarRating/5)*100);
                $twoStarRatingPercent = !empty($twoStarRatingPercent)?$twoStarRatingPercent.'%':'0%';
                
                $oneStarRatingPercent = round(($oneStarRating/5)*100);
                $oneStarRatingPercent = !empty($oneStarRatingPercent)?$oneStarRatingPercent.'%':'0%';
                $link = "book.php?bookid=".$bookId;
                if (isset($_GET['see_more'])) {
                   $link = $link."&see_more=yes";
                }
                ?>
                <a href="<?php echo $link."&rating=5" ?>">
                <div class="pull-left">
                    <div class="pull-left" style="width:35px; line-height:1;">
                        <div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
                    </div>
                    <div class="pull-left" style="width:180px;">
                        <div class="progress" style="height:9px; margin:8px 0;">
                          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $fiveStarRatingPercent; ?>">
                            <span class="sr-only"><?php echo $fiveStarRatingPercent; ?></span>
                          </div>
                        </div>
                    </div>
                    <div class="pull-right" style="margin-left:10px;"><?php echo $fiveStarRating; ?></div>
                </div>
                </a>
                <a href="<?php echo $link."&rating=4" ?>">
                <div class="pull-left">
                    <div class="pull-left" style="width:35px; line-height:1;">
                        <div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
                    </div>
                    <div class="pull-left" style="width:180px;">
                        <div class="progress" style="height:9px; margin:8px 0;">
                          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $fourStarRatingPercent; ?>">
                            <span class="sr-only"><?php echo $fourStarRatingPercent; ?></span>
                          </div>
                        </div>
                    </div>
                    <div class="pull-right" style="margin-left:10px;"><?php echo $fourStarRating; ?></div>
                </div>
            </a>
            <a href="<?php echo $link."&rating=3" ?>">
                <div class="pull-left">
                    <div class="pull-left" style="width:35px; line-height:1;">
                        <div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
                    </div>
                    <div class="pull-left" style="width:180px;">
                        <div class="progress" style="height:9px; margin:8px 0;">
                          <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $threeStarRatingPercent; ?>">
                            <span class="sr-only"><?php echo $threeStarRatingPercent; ?></span>
                          </div>
                        </div>
                    </div>
                    <div class="pull-right" style="margin-left:10px;"><?php echo $threeStarRating; ?></div>
                </div>
            </a>
            <a href="<?php echo $link."&rating=2" ?>">
                <div class="pull-left">
                    <div class="pull-left" style="width:35px; line-height:1;">
                        <div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
                    </div>
                    <div class="pull-left" style="width:180px;">
                        <div class="progress" style="height:9px; margin:8px 0;">
                          <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $twoStarRatingPercent; ?>">
                            <span class="sr-only"><?php echo $twoStarRatingPercent; ?></span>
                          </div>
                        </div>
                    </div>
                    <div class="pull-right" style="margin-left:10px;"><?php echo $twoStarRating; ?></div>
                </div>
            </a>
            <a href="<?php echo $link."&rating=1" ?>">
                <div class="pull-left">
                    <div class="pull-left" style="width:35px; line-height:1;">
                        <div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
                    </div>
                    <div class="pull-left" style="width:180px;">
                        <div class="progress" style="height:9px; margin:8px 0;">
                          <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $oneStarRatingPercent; ?>">
                            <span class="sr-only"><?php echo $oneStarRatingPercent; ?></span>
                          </div>
                        </div>
                    </div>
                    <div class="pull-right" style="margin-left:10px;"><?php echo $oneStarRating; ?></div>
                </div>
            </a>
            </div>      
            <div class="col-sm-3">
                <button type="button" id="rateProduct" class="btn btn-info <?php if(isset($_SESSION['Username'])){ echo 'login';} ?>">Rate this product</button>
            </div>      
        </div>
        <div class="row">
            <div class="col-sm-7">
                <hr/>
                <div class="review-block">      
                <?php
                $seemore = " order by users.id asc limit 5";
                if (isset($_GET['delete'])) {

                    $query = "DELETE FROM reviews WHERE user_id=".$_GET['userid']." AND book_id=".$_GET['bookid'];
                    mysqli_query($db,$query);
                }
                 if (isset($_GET['see_more'])) {
                     $seemore = "";
                 }
                 $rate = "";
                 if (isset($_GET['rating'])) {
                     $rate = " AND reviews.rating=".$_GET['rating'];
                 }
                $query="SELECT reviews.book_id, reviews.user_id, reviews.title, reviews.description, reviews.rating, users.name,users.username, users.profile_picture, users.role_id  FROM reviews 
   INNER JOIN users
     ON reviews.user_id = users.id
 WHERE reviews.book_id = '$bookId'".$rate.$seemore;
                $result=mysqli_query($db,$query);
                if ($result->num_rows > 0){
                     
                 
               // $itemRating = $rating->getItemRating($_GET['item_id']);
                while ($r=mysqli_fetch_array($result)){                
                    //$date=date_create($rating['created']);
                    //$reviewDate = date_format($date,"M d, Y");                      
                    $profilePic = "https://randomuser.me/api/portraits/lego/0.jpg";    
                    if($r['profile_picture']) {
                        $profilePic = $r['profile_picture'];    
                    }
                ?>              
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?php echo $profilePic; ?>" class="img-rounded user-pic">
                            <div class="review-block-name">By <a href="#"><?php echo $r['username']; ?></a></div>
                            <!-- <div class="review-block-date"><?php //echo $reviewDate; ?></div> -->
                        </div>
                        <div class="col-sm-9">
                            <div class="review-block-rate">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    $ratingClass = "btn-default btn-grey";
                                    if($i <= $r['rating']) {
                                        $ratingClass = "btn-warning";
                                    }
                                ?>
                                <button type="button" class="btn btn-xs <?php echo $ratingClass; ?>" aria-label="Left Align">
                                  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                </button>                               
                                <?php } ?>
                            </div>
                            <div class="review-block-title"><?php echo $r['title']; ?></div>
                            <div class="review-block-description"><?php echo htmlspecialchars($r['description'], ENT_QUOTES, 'UTF-8'); ?></div>
                            <?php
                                if (isset($_SESSION['UserID'])) {
                                    if ($_SESSION['UserID'] == $r['user_id'] && $_SESSION['RoleId'] != 1 && $_SESSION['RoleId'] != 2 && $_SESSION['RoleId'] != 7 && $_SESSION['RoleId'] != 8 && $_SESSION['RoleId'] != 9) {
                                        echo '<button type="button" id="editRate" class="btn btn-warning login">Edit Review</button>';
                                        echo '&nbsp;<a href="book.php?bookid='.$bookId.'&userid='.$_SESSION['UserID'].'&delete=true"><button type="button" class="btn btn-danger login">Delete Review</button></a>';
                                    }
                                    else if($_SESSION['RoleId']==1 ||$_SESSION['RoleId']==2 ||$_SESSION['RoleId']==7 ||$_SESSION['RoleId']==8 ||$_SESSION['RoleId']==9){
                                    ?> 
                                    <input type="hidden" name="checkdesp" id="<?php echo $r['user_id'] ?>" value=" ' <?php echo htmlspecialchars($r['description'], ENT_QUOTES, 'UTF-8') ?> '">
                                    <input type="hidden" name="checkdesp" id="<?php echo $r['user_id'] ?>title" value=" <?php echo htmlspecialchars($r['title'], ENT_QUOTES, 'UTF-8') ?> ">
                                    <button type="button" onclick="editReviewForAdmin( '<?php echo $r['user_id'] ?>', '<?php echo $r['rating'] ?>' )" class="btn btn-warning login">Edit Review</button>
                                     
                                     <?php
                                     echo '&nbsp;<a href="book.php?bookid='.$bookId.'&userid='.$r['user_id'].'&delete=true"><button type="button" class="btn btn-danger login">Delete Review</button></a>';   
                                    }

                                }
                            ?>
                        </div>
                    </div>
                    <hr/>                   
                <?php }
                if (!isset($_GET['see_more'])) {
                    echo "<a href='book.php?bookid=".$bookId."&see_more=yes'>See more reviews...</a>";
                }

            }

            }?>
                </div>
            </div>
        </div>  
    </div>
    <div id="ratingSection" style="display:none; padding-left: 5px; padding-right: 5px;">
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
                        <input type="hidden" class="form-control" id="itemId" name="itemId" value="<?php echo $_GET['bookid']; ?>">
                        <input type="hidden" name="action" id="action" value="saveRating">
                        <input type="hidden" name="userID" value="" id="userID">
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
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="loginmodal-container">
                <h1>Login to rate this product</h1><br>
                <div style="display:none;" id="loginError" class="alert alert-danger">Invalid username/Password</div>
                <form method="post" id="loginForm" name="loginForm">
                    <input type="text" name="user" placeholder="Username" required>
                    <input type="password" name="pass" placeholder="Password" required>
                    <input type="hidden" name="action" value="userLogin">
                    <input type="submit" name="login" class="login loginmodal-submit" value="Login">                     
                </form>
                <div class="login-help">                    
                    
                </div>
            </div>
        </div>
    </div>
</html>
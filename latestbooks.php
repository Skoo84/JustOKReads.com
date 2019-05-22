<html>

<?php include("config.php");

$db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");

?>
<title>Just OK Reads</title>
<link rel="stylesheet" href="navbar.css">
<link rel="stylesheet" type="text/css" href="assets/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
    .ratings i {
      color: #ff9900;
    }
  </style>
<?php include('navbar.php'); ?>
<body>

<div class="main2">
  



</div>
<div align="left" >
<?php
// se verifica daca utilizatorul este autentificat
if (isset($_SESSION['Username']))
  {
    $userName = ($_SESSION['Username']);
    echo "<h2>The user: ".$userName." is logged in.</h2>";

  }
// daca utilizatorul nu este autentificat
else
  {
    echo "<h2>The user IS NOT !!!!! NOT !LOGGED INNNNN!!!!!!</h2>";
    echo "<a href='login.php' target='_self'>Login</a>";
    echo "&nbsp; | &nbsp;";
    echo "<a href='createUser.php' target='_self'>Register new user</a>";

  }
?>

</div>


<div class="row">
  <div class="col-md-1">
    
  </div>
  <div class="col-md-10">
    <div class="panel panel-primary">
      <div class="panel-heading"><h4>Latest Books</h4></div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <h3 class="text-primary"></h3>
          </div>
          <div class="col-md-3">
            <h3 class="text-primary"></h3>
          </div>
          <div class="col-md-5">
            <h3 class="text-primary"></h3>
          </div>
        </div>
        <hr>
        <?php
        $select = "SELECT id, title, cover_photo, LEFT(description , 600) as bb FROM books ORDER by id DESC LIMIT 10";
        $run = mysqli_query($db,$select);
        while($row=mysqli_fetch_array($run))
        {
          $b_id = $row['id'];
          $title = $row['title'];
          $photo = $row['cover_photo'];
          $des = $row['bb'];
        


        ?>
        <div class="row">
          <div class="col-md-4">
            <h3 style="margin-top: 50px" > <?php echo $title; ?> </h3>

            
            <?php


            $query="SELECT r.book_id, avg(r.rating), count(r.rating) FROM reviews r
            where book_id = '$b_id'";
            $result=mysqli_query($db,$query);

            while ($r=mysqli_fetch_array($result)) {
                $rating=$r['avg(r.rating)'];
                $feedbacks=$r['count(r.rating)'];
                
                
                
                $rating_round = round($rating * 2) / 2;
                if ($rating_round <= 0.5 && $rating_round > 0) {
                  ?>
                  <div class="ratings">
                  <p>Ratings:  
                    <i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></p> 
                  </div>
                    <?php
                }
                if ($rating_round <= 1 && $rating_round > 0.5) { ?>
                  <div class="ratings">
                  <p>Ratings: <br>
                    <i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> Based On <?php echo $feedbacks; ?> Reviews</p> 
                  </div>
                    <?php
                }
                if ($rating_round <= 1.5 && $rating_round > 1) { ?>
                  <div class="ratings"> 
                    <p>Ratings: <br> 
                    <i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> Based On <?php echo $feedbacks; ?> Reviews</p> 
                  </div>
                    <?php 
                }
                if ($rating_round <= 2 && $rating_round > 1.5) { ?>
                  <div class="ratings"> 
                    <p>Ratings: <br>
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> Based On <?php echo $feedbacks; ?> Reviews</p> 
                  </div>
                   <?php
                }
                if ($rating_round <= 2.5 && $rating_round > 2) { ?>
                  <div class="ratings"> 
                    <p>Ratings:  <br>
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> Based On <?php echo $feedbacks; ?> Reviews</p> 
                  </div>
                    <?php 
                }
                if ($rating_round <= 3 && $rating_round > 2.5) {?>
                  <div class="ratings">
                  <p>Ratings:  <br> 

                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> Based On <?php echo $feedbacks; ?> Reviews</p> 
                  </div>
                    <?php
                }
                if ($rating_round <= 3.5 && $rating_round > 3) { ?>
                  <div class="ratings"> 
                    <p>Ratings:  <br>
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i> Based On <?php echo $feedbacks; ?> Reviews</p> 
                  </div>
                    <?php 
                }
                if ($rating_round <= 4 && $rating_round > 3.5) { ?>
                  <div class="ratings"> 
                    <p>Ratings: <br>
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i> Based On <?php echo $feedbacks; ?> Reviews</p> 
                  </div>
                    <?php 
                }
                if ($rating_round <= 4.5 && $rating_round > 4) { ?>
                  <div class="ratings"> 
                    <p>Ratings: <br>
                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i> Based On <?php echo $feedbacks; ?> Reviews</p>
                  </div>
                 <?php   
                }

                if ($rating_round <= 5 && $rating_round > 4.5) {?>
                <div class="ratings">  
                    <p>Ratings: <br><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> Based On <?php echo $feedbacks; ?> Reviews </p>
                </div>

  <?php 
                }
                 

                //echo " based on " .$feedbacks." reviews </p>";
              }

             //echo star_rating($rating) ;
            ?>
          </div>
          <div class="col-md-4">
            <img width="250px" src="<?php echo $photo ?>">
          </div>
          <div style="margin-top: 50px" class="col-md-4">
           <p style="font-size: 16px"> <?php echo $des.'...' ; ?></p>
          </div>
        </div>
        <br><br>
      <?php } ?>
      </div>
    </div>
  </div>
  
</div>






</body>
</html>
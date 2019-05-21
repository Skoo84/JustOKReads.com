<html>
  <style>.error {color:#FF0000;}</style>
  <title>Add a new Author</title>
  <link rel="stylesheet" href="navbar.css">
<body>


<?php include('navbar.php'); ?>
<div class="main2">
</div>
<?php
// Default error values init
$bioerr=$pictureErr=$username1err="";
// Default values for contact details
$picture=$bio=$username1="";
//Error counter
$errorCounter=0;
// Init the config file where the connection strings are stored
require_once ("config.php");
// Data Sanitization
function test_input($data)
  {
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
  }

if ($_SESSION['RoleId'] < 7){

          echo "<p align='left'> You are not allowed to add new Authors, please contract an administrator if you need this rights.</p>";
} else {
// Check if data was sent through the form
if ($_SERVER["REQUEST_METHOD"]=="POST")
  {
// Checks if the username1 field was input
    if (empty($_POST["username1"]))
      {
// Error displayed if username1 is not input
// If error occured increment error counter
        $errorCounter=1;
      }
 
        if (empty($_POST["bio"]))
          {
            $bioerr="The bio information is mandatory.";
            $errorCounter=1;
          }
        else
          {
            $bio=test_input($_POST["bio"]);
          }
          
          if (empty($_POST["picture"]))
          {
            $pictureErr="The link with the picture is mandatory.";
            $errorCounter=1;
          }
        else
          {
            $picture=test_input($_POST["picture"]);
          }


        if (empty($_POST["username1"]))
          {
            $username1err="The name of the Author is mandatory.";
            $errorCounter=1;
          }
        else
          {
            $username1=test_input($_POST["username1"]);
            if (!preg_match("/^[a-zA-Z0-9 ]*$/",$username1))
              {
                $username1err="Only letters, numbers and spaces are allowed.";
                $errorCounter=1;
              }
          }
            
// If the error counter is == 0 check if the name already exists.


      if ($errorCounter==0)
       {
         require_once ("config.php");

         $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");

         $query="SELECT * FROM $tbl_name_authors WHERE name='$username1'";
         $result=mysqli_query($db,$query);
         $num=mysqli_num_rows($result);
         if($num==1)
         {
           $username1err="The Author already exists.";
           $errorCounter=1;
         }
        }

        if ($errorCounter==0)
         {
           require_once ("config.php");

// Connect to database
          $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
// Increment the highest id that exists in db
           $query="SELECT MAX(id) AS max FROM $tbl_name_authors";
           $result=mysqli_query($db,$query);
           $result2=mysqli_fetch_array($result);
           $idnew=$result2['max']+1;
           // Sanitization
           $usrPicture=test_input($_POST["picture"]);
           $usrName=test_input($_POST["username1"]);
           $usrbio=test_input($_POST["bio"]);        


// Querry and insertion in database 

            $query="INSERT INTO $tbl_name_authors (id, name, bio, picture) VALUES ('$idnew', '$username1', '$usrbio', '$usrPicture')";
            $result=mysqli_query($db,$query);
          
// Page where the user is redirected after complete
            header("Location: createAuthor.php");
          }
  }

}
?>
<h2>Register a new Author</h2>
<p><span class="error">* Mandatory field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" target="_self" enctype="multipart/form-data">
  <fieldset>
  <legend>Personal user informations</legend>
  <br>
    Name of the Author: <br><input type="text" name="username1" value="<?php echo $username1; ?>" lenght="80">
    <span class="error">* <?php echo $username1err;?></span>
    <br>    <br>
    <!-- Bio: <br><input type="text" name="bio" value="<?php echo $bio; ?>" lenght="280"> -->
    Bio: <br>
    <textarea name="bio" style="width:250px;height:150px;"></textarea>
    <span class="error">* <?php echo $bioerr;?></span><br><br>
    <br>    
    Link with the picture: <br><input type="text" name="picture" value="<?php echo $picture; ?>" lenght="80">
    <span class="error">* <?php echo $pictureErr;?></span>
    <br>
    <input type="submit" name="submit" value="Trimite">
  </fieldset>  
  <br>
</body></html>

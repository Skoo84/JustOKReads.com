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
$bioerr=$pictureErr=$usernameerr="";
// Default values for contact details
$picture=$bio=$username="";
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
// Check if data was sent through the form
if ($_SERVER["REQUEST_METHOD"]=="POST")
  {
// Checks if the username field was input
    if (empty($_POST["username"]))
      {
// Error displayed if username is not input
// If error occured increment error counter
        $errorCounter=1;
      }
 
        if (empty($_POST["bio"]))
          {
            $bioerr="The e-mail address is mandatory.";
            $errorCounter=1;
          }
        else
          {
            $bio=test_input($_POST["bio"]);
          }
          
        if (empty($_POST["username"]))
          {
            $usernameerr="The name is mandatory.";
            $errorCounter=1;
          }
        else
          {
            $username=test_input($_POST["username"]);
            if (!preg_match("/^[a-zA-Z0-9 ]*$/",$username))
              {
                $usernameerr="Only letters, numbers and spaces are allowed.";
                $errorCounter=1;
              }
          }
            
// If the error counter is == 0 check if the name already exists.

      if ($errorCounter==0)
       {
         require_once ("config.php");

         $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");

         $query="SELECT * FROM $tbl_name_authors WHERE username='$username'";
         $result=mysqli_query($db,$query);
         $num=mysqli_num_rows($result);
         if($num==1)
         {
           $usernameerr="The selected username already exists.";
           $errorCounter=1;
         }
          $query="SELECT * FROM $tbl_name_authors WHERE bio='$bio'";
          $result=mysqli_query($db,$query);
          $num=mysqli_num_rows($result);
          if($num==1)
          {
            $bioerr="The e-mail address is already in use.";
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
// Sanatise user password
           $usrPicture=test_input($_POST["usrPictureForm"]);
// Sanitization of about
           $about1=test_input($_POST["about"]);
// Sanitization of birth date
            $birthDate=test_input($_POST["birthDate"]);     
// Encrypt password with md5
           $usrPicture=md5($usrPicture);

// Querry and insertion in database 

            $query="INSERT INTO $tbl_name_authors (id, name, bio, picture) VALUES ('$idnew', '$username', '$bio', '$usrPicture')";
            $result=mysqli_query($db,$query);
          
// Page where the user is redirected after complete
            header("Location: index.php");
          }
  }
?>
<h2>Register a new Author</h2>
<p><span class="error">* Mandatory field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" target="_self" enctype="multipart/form-data">
  <fieldset>
  <legend>Personal user informations</legend>
  <br>
    E-mail: <br><input type="text" name="bio" value="<?php echo $bio; ?>" lenght="80">
    <span class="error">* <?php echo $bioerr;?></span><br><br>
    Birth Date: <br><input type="date" name="birthDate" min="1900-01-01"value="<?php echo $birthDate; ?>" lenght=80">
    <br>    <br>
    About: <br><input type="text" name="about" value="<?php echo $about; ?>" lenght="240">
    <br>    
    
  </fieldset>
  <br>
 
  <br>
  <fieldset>
  <legend>Login Details</legend>
  <br>
    Username: <br><input type="text" name="username" value="<?php echo $username; ?>" lenght="40">
    <span class="error">* <?php echo $usernameerr;?></span><br><br>
    Password: <br><input type="password" name="usrPictureForm" lenght="40">
    <br><br>
    Repeat Password: <br><input type="password" name="usrPasswordb" lenght="40">
    <span class="error">* <?php echo $pictureErr;?></span><br>
  </fieldset>
  <br>
    <input type="submit" name="submit" value="Submit">
</form>
<br><br>
<a href='index.php' target='_self'>Home Page</a>
&nbsp; | &nbsp;
<a href='login.php' target='_self'>Login</a>
</body></html>

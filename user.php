<?php
session_start();
// Checkin User and Password for login
if (isset($_POST['submit']))
  {
  require_once ("config.php");
  $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
  $myusername=$_POST['username'];
  $mypassword=$_POST['parola'];
  $orderby=$_POST['order'];
  // Sanitization
  $myusername = stripslashes($myusername);
  $mypassword = stripslashes($mypassword);
  $myusername = mysqli_real_escape_string($db,$myusername);
  $mypassword = mysqli_real_escape_string($db,$mypassword);
  $mypassword = md5($mypassword);
  $query="SELECT * FROM $tbl_name_users WHERE username='$myusername' and password='$mypassword'";
  $result=mysqli_query($db,$query);
while($r=mysqli_fetch_array($result))
   {
   $UserID=$r["id"];
   $Username=$r["username"];
   $UserNume=$r["name"];
   $UserEmail=$r["email"];
   $BirthDate=$r["birth_date"];
   $RoleId=$r["role_id"];
   }
$count=mysqli_num_rows($result);
// Register the session details
if($count==1){
$_SESSION['Username'] = $Username;
$_SESSION['UserID'] = $UserID;
$_SESSION['UserNume'] = $UserNume;
$_SESSION['UserEmail'] = $UserEmail;
$_SESSION['BirthDate'] = $BirthDate;
$_SESSION['RoleId'] = $RoleId;
echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
}
// If user or passwod is incorrect
else {
echo "Utilizator sau parola incorecta. <br><br>
<a href='index.php' target='_self'>Prima pagina</a>
&nbsp;   |   &nbsp;
<a href='login.php' target='_self'>Inapoi la Login</a>
&nbsp;   |   &nbsp;
<a href='inscriere.php' target='_self'>Inregistrare utilizator nou</a>
";
}
}

<?php
session_start();
//include 'class/Rating.php';
//$rating = new Rating();
require_once ("config.php");
if(!empty($_POST['action']) && $_POST['action'] == 'userLogin') {
	$db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
  $myusername=$_POST['user'];
  $mypassword=$_POST['pass'];
  
  // securizare date de login avoid sql injection
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
// daca ok, inregistrare user
	$loginStatus = 0;
	$userName = "";
if($count==1){

	$loginStatus = 1;
$_SESSION['Username'] = $Username;
$_SESSION['UserID'] = $UserID;
$_SESSION['UserNume'] = $UserNume;
$_SESSION['UserEmail'] = $UserEmail;
$_SESSION['BirthDate'] = $BirthDate;
$_SESSION['RoleId'] = $RoleId;
$userName = $Username;
}

	$data = array(
		"username" => $userName,
		"success"	=> $loginStatus,	
	);
	echo json_encode($data);	
}
if(!empty($_POST['action']) && $_POST['action'] == 'saveRating' 
	&& !empty($_SESSION['UserID']) 
	&& !empty($_POST['rating']) 
	&& !empty($_POST['itemId'])) {
		$userID = $_SESSION['UserID'];	
		$rating = $_POST['rating'];
		$bookid = $_POST['itemId'];
		
		$db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
		$title = $_POST['title'];
		$description = $_POST['comment'];
		$title = mysqli_escape_string($db, $title);
		$description = mysqli_escape_string($db, $description);
		$query = "SELECT * FROM reviews WHERE user_id='$userID' AND book_id='$bookid'";
		$result=mysqli_query($db,$query);
		$count=mysqli_num_rows($result);
		if ($count>0) {
			
			$query = "UPDATE reviews SET title='$title', description='$description', rating='$rating' WHERE user_id='$userID' AND book_id='$bookid'";
		}
		else{
			
			$query = "INSERT INTO reviews(book_id, user_id, title, description, rating) VALUES('$bookid', '$userID', '$title', '$description', '$rating')";
		}
		mysqli_query($db,$query);
		$data = array(
			"success"	=> 1,	
		);
		echo json_encode($data);		
}
if(!empty($_POST['action']) && $_POST['action'] == 'AdminEdit' 
	&& !empty($_SESSION['UserID']) 
	&& !empty($_POST['rating']) 
	&& !empty($_POST['itemId'])) {
		$userID = $_POST['userID'];	
		$rating = $_POST['rating'];
		$bookid = $_POST['itemId'];
		
		$db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
		$title = $_POST['title'];
		$description = $_POST['comment'];
		$title = mysqli_escape_string($db, $title);
		$description = mysqli_escape_string($db, $description);
		// $query = "SELECT * FROM reviews WHERE user_id='$userID' AND book_id='$bookid'";
		// $result=mysqli_query($db,$query);
		// $count=mysqli_num_rows($result);
		// //if ($count>0) {
			
			$query = "UPDATE reviews SET title='$title', description='$description', rating='$rating' WHERE user_id='$userID' AND book_id='$bookid'";
		//}
		//else{
			
		//	$query = "INSERT INTO reviews(book_id, user_id, title, description, rating) VALUES('$bookid', '$userID', '$title', '$description', '$rating')";
		//}
		mysqli_query($db,$query);
		$data = array(
			"success"	=> 1,	
		);
		echo json_encode($data);		
}
// if(!empty($_GET['action']) && $_GET['action'] == 'logout') {
// 	session_unset();
// 	session_destroy();
// 	header("Location:index.php");
// }
?>
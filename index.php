<html>

<?php include("config.php");?>
<title>Just OK Reads</title>
<link rel="stylesheet" href="navbar.css">
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
    echo "<p>The user: ".$userName." is logged in.</p>";

  }
// daca utilizatorul nu este autentificat
else
  {
    echo "<p>The user IS NOT !!!!! NOT !LOGGED INNNNN!!!!!!</p>";
    echo "<a href='login.php' target='_self'>Login</a>";
    echo "&nbsp; | &nbsp;";
    echo "<a href='createUser.php' target='_self'>Inregistrare utilizator nou</a>";

  }
?>
</div>

</body>
</html>

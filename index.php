<html>
<?php session_start();?>
<?php include("config.php");?>
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
    echo "<h1>";
    echo "<a href='logout.php' target='_self'  >Logout</a>";
    echo "<br>";
    echo "<a href='search.php' target='_self'>Search</a>";
    echo "<br>";
    echo "<a href='userprofilepage.php' target='_self'>User Profile</a>";
    echo "</h1>";

  }
// daca utilizatorul nu este autentificat
else
  {
    echo "<p>The user IS NOT !!!!! NOT !LOGGED INNNNN!!!!!!</p>";
    echo "<a href='loginTemporar.php' target='_self'>Login</a>";
    echo "&nbsp; | &nbsp;";
    echo "<a href='createUser.php' target='_self'>Inregistrare utilizator nou</a>";

  }
?>
</div>

</body>
</html>

<html>
<?php session_start();?>
<?php include("config.php");?>
<body>
<div align="left">
<?php
// se verifica daca utilizatorul este autentificat
if (isset($_SESSION['Username']))
  {
    echo "<a href='logout.php' target='_self'>Logout</a>";
  }
// daca utilizatorul nu este autentificat
else
  {
    echo "<a href='login.php' target='_self'>Login</a>";
    echo "&nbsp; | &nbsp;";
    echo "<a href='createUser.php' target='_self'>Inregistrare utilizator nou</a>";
    echo "<p align='left'>Trebuie sa va autentificati sa vedeti datele utilizatorilor</p>";
  }
?>
</div>
<h2>Utilizatori inregistrati</h2>
<?php
// daca utilizatorul este autentificat se va afisa o lista cu utilizatorii in ordinea aleasa la login cu datele complete
if (isset($_SESSION['Username']))
  {
    echo "<p>The user IS LOGGED INNNNN!!!!!!</p>";
  }
// daca utilizatorul nu este autentificat se va afisa numai o lista cu username-uri fara a ordona
else
  {
    echo "<p>The user IS NOT !!!!! NOT !LOGGED INNNNN!!!!!!</p>";
    }
?>
</body>
</html>

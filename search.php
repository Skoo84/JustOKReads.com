<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
 
<h1>This wonderful search page is done. Almost ... ish </h1>

<form action="search.php" method="GET">
    <input type="text" name="query" />
    <input type="submit" value="Search" />
</form>





<?php

if (isset($_SESSION['Username']))
  {
    require_once ("config.php");
    $orderby = $_SESSION['Orderby'];
    $db=mysqli_connect($servername,$username,$password,$db_name) or die ("could not connect");
    $query="SELECT * FROM $tbl_name ORDER BY username $orderby";
    $result=mysqli_query($db,$query);
    while ($r=mysqli_fetch_array($result)) {
        $user4=$r['username'];
        echo "<div class='row'>";
        echo "<div class='column left'><p align='left'>".$user4."</p></div>";
        $nume4=$r['nume'];
        $prenume4=$r['prenume'];
        echo "<div class='column middle'><p align='left'>".$nume4." ".$prenume4."</p></div>";
        $id4=$r['id'];
        echo "<div class='column right'><p align='left'><a href='utilizatori.php?id=$id4' target='_self'>Mai multe detalii</a></p></div>";
        echo"</div>";
      }
  }

else
  {
    require_once ("config.php");
    $db=mysqli_connect($host,$usernamesql,$passwordsql,$db_name) or die ("could not connect");
    $query="SELECT * FROM $tbl_name";
    $result=mysqli_query($db,$query);
    while ($r=mysqli_fetch_array($result)) {
        $user4=$r['username'];
        echo "<p align='left'>".$user4."</p>";
      }
    }
?>
</body>
</html>
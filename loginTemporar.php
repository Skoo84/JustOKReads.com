<html>
<?php session_start();?>
<?php include("config.php");?>
<body>
<h2>Login</h2>
<form method="post" action="user.php" target="_self">
    <fieldset>
        <legend>Login</legend>
        Utilizator: <br><input type="text" name="username" lenght="40">
        <br><br>
        Parola: <br><input type="password" name="parola" lenght="40">
        <br><br>
        <input type="submit" name="submit" value="Login">
        <br>
    </fieldset>
</form>
<br><br>
<a href='index.php' target='_self'>Prima pagina</a>
&nbsp; | &nbsp;
<a href='createUser.php' target='_self'>Inregistrare utilizator nou</a>
</body></html>
<html>
<?php include("config.php"); ?>
<title>Login Page</title>
<link rel="stylesheet" href="navbar.css">
<?php include('navbar.php'); ?>

<body>
    <div class="main2"></div>
    <h2>Login page</h2>
    <form method="post" action="user.php" target="_self">
        <fieldset>
            <legend>Login</legend>
            User Name: <br><input type="text" name="username" lenght="40">
            <br><br>
            Password: <br><input type="password" name="parola" lenght="40">
            <br><br>
            <input type="submit" name="submit" value="Login">
            <br>
        </fieldset>
    </form>
    <br><br>
    <a href='index.php' target='_self'>Home page</a>
    &nbsp; | &nbsp;
    <a href='createUser.php' target='_self'>Create User</a>
</body>

</html>
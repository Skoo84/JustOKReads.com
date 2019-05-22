<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
      background-color: #DAD1C1
    }

    .navbar {
      overflow: hidden;
      background-color: #293545;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 22222;
    }

    .navbar a {
      float: left;
      display: block;
      color: #f2f2f2;
      text-align: center;
      padding: 5px 16px;
      text-decoration: none;
      font-size: 25px;
    }

    .navbar a:hover {
      background: #f1f1f1;
      color: black;
    }

    .navbar a.active {
      background-color: #4CAF50;
      color: white;
    }

    .main {
      padding: 16px;
      margin-bottom: 30px;
    }

    .topnav .search-container {
      float: right;
    }

    .topnav input[type=text] {
      padding: 6px;
      margin-top: 8px;
      font-size: 17px;
      border: none;
    }

    .topnav .search-container button {
      float: right;
      padding: 6px;
      margin-top: 8px;
      margin-right: 16px;
      background: #ddd;
      font-size: 17px;
      border: none;
      cursor: pointer;
    }

    .topnav .search-container button:hover {
      background: #ccc;
    }
  </style>
</head>

<body>
  <div class="navbar">
    <a href="index.php" class="active">
      <img src="logo.png" alt="JustOKReads.com" style="width:151px;border:0;">
    </a>
    <?php
    session_start();
    if (isset($_SESSION['Username'])) {
      echo '<a href="logout.php">Logout</a>';
      if ($_SESSION['RoleId'] >= 7) {
        echo '<a href="createAuthor.php">Add Author</a>';
      }
    } else {
      echo '<a href="login.php">Login</a>';
    }
    ?>
  <a href="search.php">Search</a>
  <a href='userprofilepage.php'>User Profile</a>
  <a href='latestbooks.php'>Latest Additions</a>




  </div>

</body>

</html>
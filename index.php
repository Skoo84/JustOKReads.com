//test----------
///564454
<?php
$servername = "echipa5.cio39zzweoyk.eu-west-1.rds.amazonaws.com";
$username = "admin";
$password = "nuav3Msef";
$db_name = "echipa5";
// Create connection
$conn = new mysqli($servername, $username, $password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "select id, name from categories";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
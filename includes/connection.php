<?php
require("constants.php");

// Data Base Connectivity...
//Step 1 : Create Database Connection

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "$conn->connect_error";
    die("Connection Failed : " . $conn->connect_error);
}

?>

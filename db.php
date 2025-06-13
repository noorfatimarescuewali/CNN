<?php
$servername = "localhost";
$username = "ulhassb3jb9ou";
$password = "mo593fha3xwg";
$dbname = "dbnv8ri1bfnsgk";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

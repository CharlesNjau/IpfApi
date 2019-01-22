<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ipf_db";

// Create connection for offline version
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    //echo "Connection failed: " . $e->getMessage();
    }
?>
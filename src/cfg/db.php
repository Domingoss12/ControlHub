<?php
function getDatabaseConnection()
{
    $host = "localhost";
    $username = "root";
    $password = "";
    $databaseName = "ControlHubdb";

    // Create Connection
    $conn = new mysqli($host, $username, $password, $databaseName);


    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

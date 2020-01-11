<?php

// We will use Mysqli OOP way

// create new Mysqli object (host, username, password, database name)
$conn = new Mysqli("localhost", "root", "123456789", "crud");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

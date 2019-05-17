<?php

$host = "localhost";
$database = "theatre";
$user = "root";
$password = "";

$link = mysqli_connect($host, $user, $password,$database);
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

<?php
include_once '../config.php';
$connection = mysqli_connect('localhost', "$username", "$password");
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, "$dbname");
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
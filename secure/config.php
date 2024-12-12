<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fisherbk";
$smtphost ="server145.web-hosting.com";
$user = "noreply@site.com";
$pass ="ALLstars_099";
$from = 'info@site.com';
$frname ="International Credit Union Bank";
$reply = "info@site.com";


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) 
	{
	    die("Connection failed: " . $conn->connect_error);
	}
	
	?>
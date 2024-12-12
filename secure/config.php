<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fisherbk";
$smtphost ="smtp.hostinger.com";
$user = "noreply@atlasfcb.com";
$pass ="STEP2_fresh";
$from = 'info@atlasfcb.com';
$frname ="Atlas Financial Bank";
$reply = "info@atlasfcb.com";


	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) 
	{
	    die("Connection failed: " . $conn->connect_error);
	}
	
	?>
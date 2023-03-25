<?php
	$host = "127.0.0.1:3306";		         // host = localhost because database hosted on the same server where PHP files are hosted
	$dbname = "post_system";              // Database name
	$username = "root";		// Database username
	$password = "Mohamed$";	        // Database password

	try {
		$conn = new mysqli($host, $username, $password, $dbname);
	} catch (Exception $e) {
		echo $e->getMessage();
	}
?>
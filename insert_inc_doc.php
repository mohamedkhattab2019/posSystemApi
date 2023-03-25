<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 1000');
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        // may also be using PUT, PATCH, HEAD etc
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    }

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
    }
    exit(0);
}
	require_once 'connection_config.php'; 
	

	if(!empty($_POST['Income_ID']) && !empty($_POST['income_document'])){
		$Income_ID 			= $_POST['Income_ID'];
		$income_document 	= $_POST['income_document'];

		try {
			$sql = "INSERT INTO `post_system`.`income_document`
					(
					`Income_ID`,
					`income_document`)
					VALUES
					(
					'$Income_ID',
					'$income_document');"; 
			$result = $conn->query($sql);
			echo $result;
		} catch (Exception $e) {
			$msg["status"] = "Registeration error";
			echo $e  ;
		}
	}
	else{
		echo 'No Data Posted!';
	}

	
	// Close MySQL connection
	$conn->close();
	
?>
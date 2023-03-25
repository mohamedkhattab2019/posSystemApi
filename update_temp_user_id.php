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


	
	if(!empty($_POST['user_id']) &&!empty($_POST['user_temp_id'])){
		$user_id 	= $_POST['user_id'];
		$user_temp_id 		= $_POST['user_temp_id'];
		$sql = "UPDATE post_system.users SET user_temp_id = '$user_id' WHERE user_id = '$user_temp_id'"; 
		$result = $conn->query($sql);
		echo $result;
	}
	else if (!empty($_POST['user_id'])) {
		$user_id 	= $_POST['user_id'];
		$sql = "UPDATE post_system.users SET user_temp_id = NULL WHERE user_id = '$user_id'"; 
		$result = $conn->query($sql);
		echo $result;
	}
	else{
		echo 'No Data Posted!';
	}

	
	// Close MySQL connection
	$conn->close();
	
?>
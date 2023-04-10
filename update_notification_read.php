<?php	
    require_once 'connection_config.php'; 
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
	


	
	if(isset($_POST['depart_id']) && isset($_POST['Income_ID'])){
		$depart_id 	        = $_POST['depart_id'];
        $Income_ID 		= $_POST['Income_ID'];
        if ($depart_id 	==1) {
            $sql = "UPDATE post_system.income SET seen_by_manager = 1 WHERE Income_ID = '$Income_ID'"; 
            $result = $conn->query($sql);
            echo $result. "Updated Successfully";
        }
        else {
            $sql = "UPDATE post_system.manager_assigned SET notification_read = 1 WHERE Income_ID = '$Income_ID' AND Assigned_To = '$depart_id'"; 
            $result = $conn->query($sql);
            echo $result. "Updated Successfully";
        }
	}
	
	else{
		echo 'No Data Posted!';
	}

	
	// Close MySQL connection
	$conn->close();
	
?>
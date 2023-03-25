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
	

	if(!empty($_POST['Income_ID'])){
		$Income_ID 			= $_POST['Income_ID'];
		try {
			$sql = "SELECT Income_Document FROM post_system.income_document WHERE Income_ID = '$Income_ID'"; 
			$result = $conn->query($sql);
			$rows = array();
			if($result)
			{
				while($row = mysqli_fetch_assoc($result))
				{
					$rows[] = $row;

					//decoded base64
					//echo base64_decode($row["Income_Document"]); 

					//base64
					//echo $row["Income_Document"];

					$pdf = fopen ($Income_ID . '.pdf','w');
					fwrite ($pdf,base64_decode($row["Income_Document"])	);
					// close output file
					fclose ($pdf);
				}
				// print json_encode($rows);
				
			}
		} catch (Exception $e) {
			$msg["status"] = "Registeration error";
		}
	}
	else{
		echo 'No Data Posted!';
	}

	
	// Close MySQL connection
	$conn->close();
	
?>
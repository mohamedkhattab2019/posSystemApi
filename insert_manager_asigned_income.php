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


	if(!empty($_POST['Income_ID']) && !empty($_POST['Assigned_From']) && !empty($_POST['Assigned_To']) && !empty($_POST['Action_Type']) && !empty($_POST['manager_assigned_text'])){
		$Income_No 			= $_POST['Income_ID'];
		$Assigned_From 	= $_POST['Assigned_From'];
		$Assigned_To = $_POST['Assigned_To'];
		$Action_Type = $_POST['Action_Type'];
		$manager_assigned_text = $_POST['manager_assigned_text'];
		$Assigned_To = explode(",",$Assigned_To);
		$Action_Type = explode(",",$Action_Type);
		$manager_assigned_text = explode(",",$manager_assigned_text);

		try {
			for ($i=0; $i < count($Assigned_To) ; $i++) { 
				$query = "SELECT COUNT(*) AS total FROM post_system.manager_assigned WHERE Income_ID = $Income_No AND Assigned_From = $Assigned_From AND Assigned_To = $Assigned_To[$i]";
				$results = $conn->query($query);
				$values = mysqli_fetch_assoc($results);
				$num_rows = $values['total'];
				if ($num_rows == 0) {
				$sql = "INSERT INTO `post_system`.`manager_assigned`
					(`Income_ID`,
					`Assigned_From`,
					`Assigned_To`,
					`Action_Type`,
					`manager_assigned_text`)
					VALUES
					($Income_No,
					 $Assigned_From,
					 $Assigned_To[$i],
					 $Action_Type[$i],
					 '$manager_assigned_text[$i]'
					 )
					;"; 
				$result = $conn->query($sql);
			}
			}
		} catch (Exception $e) {
			echo $e;
			$msg["status"] = "Registeration error";
		}
	}
	elseif(!empty($_POST['Income_ID']) && !empty($_POST['Assigned_To']) && !empty($_POST['Action_text'])){
		$Action_text 	= $_POST['Action_text'];
		$Income_ID 		= $_POST['Income_ID'];
		$Assigned_To	= $_POST['Assigned_To'];
		$sql = "UPDATE `post_system`.`manager_assigned`
		SET `Action_text` = '$Action_text' WHERE `Income_ID` = $Income_ID AND `Assigned_To` = $Assigned_To;"; 
		$result = $conn->query($sql);
		echo $result;
	}
	else{
		echo 'No Data Posted!';
	}

	
	// Close MySQL connection
	$conn->close();
	
?>
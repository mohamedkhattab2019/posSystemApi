<?php
	require_once 'connection_config.php'; 
	
	if(!empty($_POST['depart_parent_id'])){
		$depart_parent_id = $_POST['depart_parent_id'];
		try {
				$sql = " SELECT * FROM departments WHERE depart_parent_id = '$depart_parent_id' ";
				$result = $conn->query($sql);
				$rows = array();
				if($result)
				{
					while($row = mysqli_fetch_assoc($result))
					{
						$rows[] = $row;
					}
					print json_encode($rows);
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
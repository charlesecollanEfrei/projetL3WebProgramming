<?php
	/****************************************************************************************************
	 *                                                                                                  *
	 * CHARLES ECOLLAN                                                                                    *
	 * EFREI                                                                                            *
	 * PHP Application - Web - APU Malaysia                                                            *
	 *                                                                                                  *
	 ****************************************************************************************************/
	// To view any errors (MAC users)
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	
	if (!empty($_POST['id']) &&
		!empty($_POST['phone']) &&
		!empty($_POST['category'])
	) {
		
		$co = mysqli_connect("localhost", "root", "root", "hotel");
		// Check connection
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		$sql = "UPDATE ROOM
				SET phone_room='$_POST[phone]',
					id_category='$_POST[category]'
				WHERE id_room='$_POST[id]'
					";
		
		
		mysqli_query($co, $sql) or die("Error Category : " . mysqli_error($co));
		
		mysqli_close($co);
		
		header('Location: ../rooms.php');
		exit;
		
	} else {
		header('Location: ../rooms.php');
		exit;
	}

?>
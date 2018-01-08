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
	
	if (!empty($_GET['id'])) {
		
		$co = mysqli_connect("localhost", "root", "root", "hotel");
		// Check connection
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		$id_booking = $_GET["id"];
		
		$sql = "DELETE
				FROM to_concern
				WHERE id_booking='$id_booking'
					";
		
		mysqli_query($co, $sql) or die("Error to_concern : " . mysqli_error($co));
		
		
		$sql = "DELETE
				FROM BOOKING
				WHERE id_booking='$id_booking'
					";
		
		mysqli_query($co, $sql) or die("Error Booking : " . mysqli_error($co));
		
		mysqli_close($co);
		
		header('Location: ../reservations.php');
		exit;
		
	} else {
		header('Location: ../reservations.php');
		exit;
	}

?>
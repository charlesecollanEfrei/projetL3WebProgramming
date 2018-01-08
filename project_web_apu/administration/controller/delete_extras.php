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
		
		$id_extras = $_GET["id"];
		
		$sql = "DELETE
				FROM to_use
				WHERE id_extras='$id_extras'
					";
		
		mysqli_query($co, $sql) or die("Error to_use : " . mysqli_error($co));
		
		
		$sql = "DELETE
				FROM EXTRAS
				WHERE id_extras='$id_extras'
					";
		
		mysqli_query($co, $sql) or die("Error Extras : " . mysqli_error($co));
		
		mysqli_close($co);
		
		header('Location: ../reservations.php');
		exit;
		
	} else {
		header('Location: ../reservations.php');
		exit;
	}

?>
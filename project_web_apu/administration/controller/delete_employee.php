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
		
		$sql = "DELETE
				FROM EMPLOYEE
				WHERE id_employee='$_GET[id]'
					";
		
		mysqli_query($co, $sql) or die("Error Employee : " . mysqli_error($co));
		
		mysqli_close($co);
		
		header('Location: ../employee.php');
		exit;
		
	} else {
		header('Location: ../employee.php');
		exit;
	}

?>
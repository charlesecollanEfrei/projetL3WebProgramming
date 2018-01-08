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
		!empty($_POST['name']) &&
		!empty($_POST['price'])
	) {
		
		$co = mysqli_connect("localhost", "root", "root", "hotel");
		// Check connection
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		$sql = "UPDATE EXTRAS
				SET name_extras='$_POST[name]',
					price_extras='$_POST[price]'
				WHERE id_extras='$_POST[id]'
					";
		
		
		mysqli_query($co, $sql) or die("Error Extras : " . mysqli_error($co));
		
		mysqli_close($co);
		
		header('Location: ../view_extras.php?id=' . $_POST["id"] . '');
		exit;
		
	} else {
		header('Location: ../reservations.php');
		exit;
	}

?>
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
	
	if (!empty($_POST['name']) &&
		!empty($_POST['floor']) &&
		!empty($_POST['max_people']) &&
		!empty($_POST['smoking']) &&
		!empty($_POST['price'])
	) {
		
		$co = mysqli_connect("localhost", "root", "root", "hotel");
		// Check connection
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		$sql = "INSERT INTO CATEGORY
					VALUES(
					'',
					'$_POST[name]',
					'$_POST[floor]',
					'$_POST[max_people]',
					'$_POST[smoking]',
					'$_POST[price]'
					)
					";
		
		mysqli_query($co, $sql) or die("Error Category : " . mysqli_error($co));
		
		mysqli_close($co);
		
		header('Location: ../categories.php');
		exit;
		
	} else {
		header('Location: ../create_category.php');
		exit;
	}

?>
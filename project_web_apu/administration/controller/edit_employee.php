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
		!empty($_POST['first_name']) &&
		!empty($_POST['last_name']) &&
		!empty($_POST['email']) &&
		!empty($_POST['phone']) &&
		!empty($_POST['job']) &&
		!empty($_POST['password'])
	) {
		
		$co = mysqli_connect("localhost", "root", "root", "hotel");
		// Check connection
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		
		$sql = "UPDATE EMPLOYEE
				SET first_name_employee='$_POST[first_name]',
					last_name_employee='$_POST[last_name]',
					e_mail_employee='$_POST[email]',
					phone_employee='$_POST[phone]',
					job_employee='$_POST[job]',
					password='$_POST[password]'
				WHERE id_employee='$_POST[id]'
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
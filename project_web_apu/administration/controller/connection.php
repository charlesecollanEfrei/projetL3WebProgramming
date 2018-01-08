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
	
	if (!empty($_POST['email']) && !empty($_POST['password'])) {
		
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$co = mysqli_connect("localhost", "root", "root", "hotel");
		// Check connection
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		$sql = "					SELECT id_employee, job_employee
									FROM EMPLOYEE
                                    WHERE e_mail_employee = '$email'
                                    AND password = '$password'
									";
		
		$result = mysqli_query($co, $sql);
		
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_array($result);
			
			session_start();
			
			$_SESSION['id_employee'] = $row['id_employee'];
			$_SESSION['job_employee'] = $row['job_employee'];
			
			mysqli_close($co);
			
			header('Location: ../home.php');
			exit;
		} else {
			mysqli_close($co);
			header('Location: ../index.php');
			exit;
		}
		
		
	} else {
		header('Location: ../index.php');
		exit;
	}

?>
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
	
	if (!empty($_POST['id_booking']) &&
		!empty($_POST['id_customer']) &&
		!empty($_POST['check_in']) &&
		!empty($_POST['check_out']) &&
		!empty($_POST['people']) &&
		!empty($_POST['first_name']) &&
		!empty($_POST['last_name']) &&
		!empty($_POST['email']) &&
		!empty($_POST['phone']) &&
		!empty($_POST['address']) &&
		!empty($_POST['city']) &&
		!empty($_POST['country']) &&
		!empty($_POST['passport'])
	) {
		
		$co = mysqli_connect("localhost", "root", "root", "hotel");
		// Check connection
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		$sql = "UPDATE BOOKING
				SET check_in_booking='$_POST[check_in]',
					check_out_booking='$_POST[check_out]',
					people_booking='$_POST[people]',
					status='$_POST[status]'
				WHERE id_booking='$_POST[id_booking]'
					";
		
		mysqli_query($co, $sql) or die("Error Booking : " . mysqli_error($co));
		
		
		$sql = "UPDATE CUSTOMER
				SET first_name_customer='$_POST[first_name]',
					last_name_customer='$_POST[last_name]',
					e_mail_customer='$_POST[email]',
					phone_customer='$_POST[phone]',
					address_customer='$_POST[address]',
					city_customer='$_POST[city]',
					country_customer='$_POST[country]',
					passport_customer='$_POST[passport]'
				WHERE id_customer='$_POST[id_customer]'
					";
		
		
		mysqli_query($co, $sql) or die("Error Customer : " . mysqli_error($co));
		
		
		mysqli_close($co);
		
		header('Location: ../view_booking.php?id=' . $_POST["id_booking"] . '');
		exit;
	} else {
		header('Location: ../reservations.php');
		exit;
	}

?>
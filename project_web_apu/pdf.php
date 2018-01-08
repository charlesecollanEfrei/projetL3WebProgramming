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
	
	require_once('classes/pdf.php');
	
	if (!empty($_POST['check_in']) &&
		!empty($_POST['check_out']) &&
		!empty($_POST['people']) &&
		!empty($_POST['booking_number']) &&
		!empty($_POST['first_name']) &&
		!empty($_POST['last_name']) &&
		!empty($_POST['email']) &&
		!empty($_POST['phone']) &&
		!empty($_POST['address']) &&
		!empty($_POST['city']) &&
		!empty($_POST['country']) &&
		!empty($_POST['passport']) &&
		!empty($_POST['name']) &&
		!empty($_POST['floor']) &&
		!empty($_POST['max_people']) &&
		!empty($_POST['number_night']) &&
		!empty($_POST['total_price'])
	) {
		
		$pdf = new pdf();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times', '', 11);
		
		$pdf->Cell(0, 10, 'Booking number: ' . $_POST['booking_number'], 0, 1);
		$pdf->Cell(0, 5, 'Check In: ' . $_POST['check_in'], 0, 1);
		$pdf->Cell(0, 5, 'Chec Out: ' . $_POST['check_out'], 0, 1);
		
		$pdf->Cell(0, 15, 'First Name: ' . $_POST['first_name'], 0, 1);
		$pdf->Cell(0, 5, 'Last Name: ' . $_POST['last_name'], 0, 1);
		$pdf->Cell(0, 5, 'Email: ' . $_POST['email'], 0, 1);
		$pdf->Cell(0, 5, 'Phone: ' . $_POST['phone'], 0, 1);
		$pdf->Cell(0, 5, 'Address: ' . $_POST['address'], 0, 1);
		$pdf->Cell(0, 5, 'City: ' . $_POST['city'], 0, 1);
		$pdf->Cell(0, 5, 'Country: ' . $_POST['country'], 0, 1);
		$pdf->Cell(0, 5, 'Passport: ' . $_POST['passport'], 0, 1);
		
		if ($_POST['smoking'] == 0)
			$_POST['smoking'] = "No";
		else $_POST['smoking'] = "Yes";
		
		$pdf->Cell(0, 15, '', 0, 1);
		$pdf->Cell(0, 5, 'Name: ' . $_POST['name'], 0, 1);
		$pdf->Cell(0, 5, 'Floor: ' . $_POST['floor'], 0, 1);
		$pdf->Cell(0, 5, 'Max people: ' . $_POST['max_people'], 0, 1);
		$pdf->Cell(0, 5, 'Smoking: ' . $_POST['smoking'], 0, 1);
		$pdf->Cell(0, 5, 'Number of night: ' . $_POST['number_night'], 0, 1);
		
		$pdf->Cell(0, 10, '', 0, 1);
		$pdf->Cell(0, 5, 'Total price: ' . $_POST['total_price'] . "$", 0, 1);
		
		$pdf->Cell(0, 15, '', 0, 1);
		$pdf->Cell(0, 05, 'Thank you for your reservation.', 0, 1);
		$pdf->Cell(0, 5, 'This pdf document is not compulsory for your check in but it is advisable in order to have the booking number.', 0, 1);
		$pdf->Cell(0, 5, 'Only your passport will be required.', 0, 1);
		
		$pdf->Output();
		
	} else {
		header('Location: book.php');
	}

?>
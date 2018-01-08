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
	
	require_once('../classes/pdf.php');
	
	if (!empty($_POST['id']) &&
		!empty($_POST['night']) &&
		!empty($_POST['extras'])
	) {
		
		$co = mysqli_connect("localhost", "root", "root", "hotel");
		// Check connection
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		$total = $_POST['night'] + $_POST['extras'];
		$total_discount = $total - $_POST['discount'];
		
		$sql = "INSERT INTO BILL
					VALUES(
					'',
					'$total',
					'$_POST[discount]',
					'$total_discount',
					$_POST[id]
					)
					";
		
		mysqli_query($co, $sql) or die("Error Bill : " . mysqli_error($co));
		
		mysqli_close($co);
		
		$pdf = new pdf();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times', '', 11);
		
		$pdf->Cell(0, 10, 'Booking number: ' . $_POST['id'], 0, 1);
		
		$pdf->Cell(0, 15, 'Night: ' . $_POST['night'] . ' $', 0, 1);
		$pdf->Cell(0, 5, 'Extras: ' . $_POST['extras'] . ' $', 0, 1);
		
		$pdf->Cell(0, 15, 'Total: ' . $total . ' $', 0, 1);
		$pdf->Cell(0, 5, 'Discount: ' . "-" . $_POST['discount'] . ' $', 0, 1);
		
		$pdf->Cell(0, 15, 'Total with discount: ' . $total_discount . ' $', 0, 1);
		
		$pdf->Cell(0, 20, 'Thank you and see you soon!', 0, 1);
		
		$pdf->Output();
		
	} else {
		header('Location: reservations.php');
		exit;
	}

?>
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
	
	session_start();
	
	if (!(isset($_SESSION['id_employee']))) {
		header('Location: index.php');
		exit;
	} else if (empty($_GET['id'])) {
		header('Location: reservations.php');
	}
	
	$co = mysqli_connect("localhost", "root", "root", "hotel");
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	
	$sql = "	SELECT price_category
				FROM to_concern TC, ROOM R, CATEGORY C
				WHERE TC.id_room = R.id_room
				AND R.id_category = C.id_category
				AND TC.id_booking = $_GET[id];
	  			";
	
	$result = mysqli_query($co, $sql) or die("Error");
	$row = mysqli_fetch_array($result);
	
	$price_room = $row['price_category'];
	
	
	$sql = "	SELECT check_in_booking, check_out_booking
				FROM BOOKING
				WHERE id_booking = $_GET[id];
	  			";
	
	$result = mysqli_query($co, $sql) or die("Error");
	$row = mysqli_fetch_array($result);
	
	$check_in = $row['check_in_booking'];
	$check_out = $row['check_out_booking'];
	
	$datetime1 = new DateTime($check_in);
	$datetime2 = new DateTime($check_out);
	$interval = $datetime1->diff($datetime2);
	$night = $interval->format('%a');
	
	$total_price_night = $price_room * $night;
	
	
	$sql = "	SELECT SUM(price_extras) as price
				FROM to_use U, EXTRAS E
				WHERE U.id_extras = E.id_extras
				AND U.id_booking = $_GET[id];
	  			";
	
	$result = mysqli_query($co, $sql) or die("Error");
	$row = mysqli_fetch_array($result);
	
	$total_extras = $row['price'];
	
	
	$sql = "  SELECT id_bill
			  	  FROM BILL B
				  WHERE id_booking = $_GET[id];
				  ";
	
	$result = mysqli_query($co, $sql);
	
	$row = mysqli_num_rows($result);
	
	if (mysqli_num_rows($result) > 0) {
		$message = "Bill aldready generated";
	} else {
		$message = "Bill not yet generated";
	}
	
	mysqli_close($co);
?>

<!DOCTYPE>

<html>
	<head>
		<title>Bill - Charli Hotel</title>
		<link href="../styles/style.css" rel="stylesheet" type="text/css">
	</head>
	
	<body>
		<header>
			<?php
				
				if (is_readable("../includes/header_admin.php")) {
					include("../includes/header_admin.php");
				} else {
					echo "Can not load header";
				}
			
			?>
		</header>
		
		<nav>
			<?php
				
				if (is_readable("../includes/menu_admin.php")) {
					include("../includes/menu_admin.php");
				} else {
					echo "Can not load menu";
				}
			
			?>
		</nav>
		
		<section class="title">
			<h1>Bill - Booking n° <?php echo $_GET["id"]; ?></h1>
		</section>
		
		<section>
			<article>
				<p style="color:red;text-align: center;"><?php echo $message; ?></p>
			</article>
			<article>
				<form action="bill_generate.php" method="post" target=_BLANK>
					<p>
						<input title="id" type="text" id="id" name="id" required="required" readonly hidden
							   value="<?php echo $_GET["id"] ?>"/>
					</p>
					<p>
						<label for="night">Room: (<?php echo $night . " night"; ?>)</label>
						<input type="text" id="night" name="night" required="required" readonly
							   value="<?php echo $total_price_night ?>"/>
					</p>
					<p>
						<label for="extras">Extras:</label>
						<input type="text" id="extras" name="extras" required="required"
							   value="<?php echo $total_extras ?>"/>
					</p>
					<p>
						Total without discount: <?php echo ($total_price_night + $total_extras) . " $"; ?>
					</p>
					<p>
						<label for="discount">Discount:</label>
						<input type="text" id="discount" name="discount" value="0" required="required"/>
					</p>
					<p>
						<input type="submit" name="Submit" value="Submit">
					</p>
				</form>
			</article>
		</section>
		
		<footer>
			<?php
				
				if (is_readable("../includes/footer.php")) {
					include("../includes/footer.php");
				} else {
					echo "Can not load footer";
				}
			
			?>
		</footer>
	</body>
</html>
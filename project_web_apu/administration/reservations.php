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
	}
	
	
	$co = mysqli_connect("localhost", "root", "root", "hotel");
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	
	if (!empty($_GET['booking_number'])) {
		$sql = "	SELECT B.id_booking, B.check_in_booking, B.check_out_booking, B.status, C.id_room
				FROM BOOKING B, to_concern C
				WHERE B.id_booking = C.id_booking
				AND B.id_booking = $_GET[booking_number];
	  			";
	} else if (!empty($_GET['room_number'])) {
		$sql = "	SELECT B.id_booking, B.check_in_booking, B.check_out_booking, B.status, C.id_room
				FROM BOOKING B, to_concern C
				WHERE B.id_booking = C.id_booking
				AND B.id_booking = $_GET[room_number];
	  			";
	} else if (!empty($_GET['choice'])) {
		if ($_GET['choice'] == "old") {
			$sql = "	SELECT B.id_booking, B.check_in_booking, B.check_out_booking, B.status, C.id_room
				FROM BOOKING B, to_concern C
				WHERE B.id_booking = C.id_booking
				AND B.status = 2;
	  			";
		} else if ($_GET['choice'] == "current") {
			$sql = "	SELECT B.id_booking, B.check_in_booking, B.check_out_booking, B.status, C.id_room
				FROM BOOKING B, to_concern C
				WHERE B.id_booking = C.id_booking
				AND B.status = 1;
	  			";
		} else if ($_GET['choice'] == "upcoming") {
			$sql = "	SELECT B.id_booking, B.check_in_booking, B.check_out_booking, B.status, C.id_room
				FROM BOOKING B, to_concern C
				WHERE B.id_booking = C.id_booking
				AND B.status = 0;
  	  			";
		} else {
			$sql = "	SELECT B.id_booking, B.check_in_booking, B.check_out_booking, B.status, C.id_room
				FROM BOOKING B, to_concern C
				WHERE B.id_booking = C.id_booking;
	  			";
		}
	} else {
		$sql = "	SELECT B.id_booking, B.check_in_booking, B.check_out_booking, B.status, C.id_room
				FROM BOOKING B, to_concern C
				WHERE B.id_booking = C.id_booking;
				
	  			";
	}
	
	$result = mysqli_query($co, $sql);
	
	mysqli_close($co);
?>

<!DOCTYPE>

<html>
	<head>
		<title>Reservation - Charli Hotel</title>
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
			<h1>Reservation</h1>
		</section>
		
		<section>
			<article class="border">
				<a class="left" title="old_booking" href="reservations.php?choice=old">Old booking</a>
				<a class="center" title="current_booking" href="reservations.php?choice=current">Current booking</a>
				<a class="right" title="upcoming_booking" href="reservations.php?choice=upcoming">Upcoming booking</a>
				<br/><br/>
			</article>
			
			<article>
				<form action="" method="get">
					<label for="booking_number"> Search by booking number: </label>
					<input type="text" id="booking_number" name="booking_number" required="required"/>
					
					<input type="submit" name="Search" value="Search">
				</form>
				
				<form action="" method="get">
					<label for="room_number"> Search by room number: </label>
					<input type="text" id="room_number" name="room_number" required="required"/>
					
					<input type="submit" name="Search" value="Search">
				</form>
			</article>
			
			<article>
				<table>
					<tr>
						<td><h3>Id</h3></td>
						<td><h3>Room</h3></td>
						<td><h3>Check In</h3></td>
						<td><h3>Check Out</h3></td>
						<td><h3>Status </h3><h6>(0 = Booking, 1 = Check In, 2 = Check Out )</h6></td>
					</tr>
					
					<?php
						while ($row = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>";
							echo "<a title='view_booking' href='view_booking.php?id=" . $row['id_booking'] . "'> " . $row['id_booking'] . " </a>";
							echo "</td>";
							echo "<td>";
							echo $row['id_room'];
							echo "</td>";
							echo "<td>";
							echo $row['check_in_booking'];
							echo "</td>";
							echo "<td>";
							echo $row['check_out_booking'];
							echo "</td>";
							echo "<td>";
							echo $row['status'];
							echo "</td>";
							echo "</tr>";
						}
					?>
				</table>
				<br/>
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
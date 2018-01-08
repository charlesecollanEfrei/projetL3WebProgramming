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
	
	require_once("functions.php");
	
	$date_today = date("d-m-Y");
	$tomorrow = new DateTime('tomorrow');
	$date_tomorrow = $tomorrow->format('d-m-Y');
	
	$co = mysqli_connect("localhost", "root", "root", "hotel");
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	if (!empty($_GET['check_in']) && !empty($_GET['check_out'])) {
		$date = $_GET['check_in'];
		$check_in = date('Y-m-d', strtotime($date));
		
		$date = $_GET['check_out'];
		$date = date('Y-m-d', strtotime($date));
		
		$check_out_init = date('Y-m-d', strtotime($date));
		$check_out = date("Y-m-d", strtotime("$date -1 days"));
		$check_in_bis = date("Y-m-d", strtotime("$check_in +1 days"));
		
		
	} else {
		$check_in = '1990-02-19';
		$check_out = '1990-02-19';
		$check_in_bis = '1990-02-20';
		$check_out_init = '1990-02-20';
	}
	
	
	$sql = "	SELECT id_category, name_category, floor_category, max_people_category, smoking_category, price_category
									FROM CATEGORY
                                    WHERE id_category NOT IN (SELECT id_category
                                                              FROM ROOM R, to_concern B, BOOKING BO
															  WHERE R.id_room = B.id_room
															  AND B.id_booking = BO.id_booking
															  AND( (BO.check_in_booking BETWEEN '$check_in' AND '$check_out')
															  OR (BO.check_out_booking BETWEEN '$check_in_bis' AND '$check_out'))
															 )
									";
	
	$result = mysqli_query($co, $sql);
	
	mysqli_close($co);
?>

<!DOCTYPE>

<html>
	<head>
		<title>Book</title>
		<link href="styles/style.css" rel="stylesheet" type="text/css">
	</head>
	
	<body>
		<header>
			<?php
				
				if (is_readable("includes/header.php")) {
					include("includes/header.php");
				} else {
					echo "Can not load header";
				}
			
			?>
		</header>
		
		<nav>
			<?php
				
				if (is_readable("includes/menu.php")) {
					include("includes/menu.php");
				} else {
					echo "Can not load menu";
				}
			
			?>
		</nav>
		
		<section class="title">
			<h1>Book a room</h1>
		</section>
		
		<section>
			<article>
				<form action="" method="get">
					
					<p>
						<label for="check_in"> Check-In: </label>
						<input type="date" id="check_in" name="check_in" required="required"
							   value="<?php echo $date_today ?>"/>
					</p>
					
					<p>
						<label for="check_out"> Check-Out: </label>
						<input type="date" id="check_out" name="check_out" required="required"
							   value="<?php echo $date_tomorrow ?>"/>
					</p>
					
					<p>
						<input type="submit" name="Submit">
					</p>
				</form>
			</article>
			
			<article>
				<?php
					if (!empty($_GET['check_in']) && !empty($_GET['check_out'])) {
						echo '<strong>Check in : </strong>' . $check_in . '<br/>';
						echo '<strong>Check out : </strong>' . $check_out_init . '<br/>';
					}
				?>
				<table>
					<tr>
						<td><h3>Name</h3></td>
						<td><h3>Floor</h3></td>
						<td><h3>Maximum People</h3></td>
						<td><h3>Smoking</h3></td>
						<td><h3>Price</h3></td>
					</tr>
					
					<?php
						while ($row = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>";
							echo "<a title='book' href='booking.php?category=" . $row['id_category'] . "&check_in=" . $check_in . "&check_out=" . $check_out_init . "&check_in_bis=" . $check_in_bis . "'> " . $row['name_category'] . " </a>";
							echo "</td>";
							echo "<td>";
							echo $row['floor_category'];
							echo "</td>";
							echo "<td>";
							echo $row['max_people_category'];
							echo "</td>";
							echo "<td>";
							
							if ($row['smoking_category'] == 0)
								echo "No";
							else echo "Yes";
							
							echo "</td>";
							echo "<td>";
							echo $row['price_category'];
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
				
				if (is_readable("includes/footer.php")) {
					include("includes/footer.php");
				} else {
					echo "Can not load footer";
				}
			
			?>
		</footer>
	</body>
</html>
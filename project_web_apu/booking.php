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
	
	$co = mysqli_connect("localhost", "root", "root", "hotel");
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	if (!empty($_GET['category']) && !empty($_GET['check_in']) && !empty($_GET['check_out']) && !empty(($_GET['check_in_bis']))) {
		$category = $_GET['category'];
		$check_in = $_GET['check_in'];
		$check_out = $_GET['check_out'];
		$check_in_bis = $_GET['check_in_bis'];
	} else {
		header('Location: book.php');
	}
	
	$name = "";
	$floor = "";
	$max_people = "";
	$smoking = "";
	$price = "";
	
	$sql = "	SELECT *
									FROM CATEGORY
                                    WHERE id_category = '$category'
									";
	
	$result = mysqli_query($co, $sql);
	
	
	while ($row = mysqli_fetch_array($result)) {
		$name = $row['name_category'];
		$floor = $row['floor_category'];
		$max_people = $row['max_people_category'];
		$smoking = $row['smoking_category'];
		$price = $row['price_category'];
	}
	
	if ($smoking == 0)
		$smoking = "No";
	else $smoking = "Yes";
	
	$datetime1 = new DateTime($check_in);
	$datetime2 = new DateTime($check_out);
	$interval = $datetime1->diff($datetime2);
	$night = $interval->format('%a');
	
	$total_price = $price * $night;
	
	
	$sql = "	SELECT MIN(R.id_room) AS room
									FROM CATEGORY C, ROOM R
                                    WHERE C.id_category = R.id_category
                                    AND C.id_category = '$category'
                                    AND id_room NOT IN (SELECT R.id_room
                                                              FROM ROOM R, to_concern B, BOOKING BO
															  WHERE R.id_room = B.id_room
															  AND B.id_booking = BO.id_booking
															  AND( (BO.check_in_booking BETWEEN '$check_in' AND '$check_out')
															  OR (BO.check_out_booking BETWEEN '$check_in_bis' AND '$check_out'))
															 )";
	
	
	$result = mysqli_query($co, $sql);
	
	$row = mysqli_fetch_array($result);
	$id_room = $row['room'];
	
	mysqli_close($co);


?>

<!DOCTYPE>

<html>
	<head>
		<title>Booking</title>
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
				<h3>Your choice:</h3>
				<strong>Name:</strong> <?php echo $name; ?> <br/>
				<strong>Floor:</strong> <?php echo $floor; ?> <br/>
				<strong>Max people:</strong> <?php echo $max_people; ?> <br/>
				<strong>Smoking:</strong> <?php echo $smoking; ?> <br/>
				<strong>Price:</strong> <?php echo $price; ?>$/night <br/>
				
				<hr>
				<strong>Number of nights:</strong> <?php echo $night; ?> <br/>
				<strong>Total price:</strong> <?php echo $total_price; ?>$ <br/>
				
				<hr>
				
				<form action="validate-booking.php" method="post">
					<input title="check_in" type="date" id="check_in" name="check_in" required="required" readonly
						   hidden value="<?php echo $check_in ?>"/>
					<input title="check_out" type="date" id="check_out" name="check_out" required="required" readonly
						   hidden value="<?php echo $check_out ?>"/>
					<input title="id_room" type="text" name="id_room" id="id_room" required="required" readonly hidden
						   value="<?php echo $id_room ?>"/>
					<input title="night" type="text" name="night" id="night" required="required" readonly hidden
						   value="<?php echo $night ?>"/>
					<input title="total_price" type="text" name="total_price" id="total_price" required="required"
						   readonly hidden value="<?php echo $total_price ?>"/>
					
					
					<p>
						<label for="people">People:</label>
						<input type="number" id="people" name="people" required="required" min="1"
							   max="<?php echo $max_people; ?>" value="1"/>
					</p>
					<p>
						<label for="first_name">First Name:</label>
						<input type="text" id="first_name" name="first_name" required="required"/>
					</p>
					<p>
						<label for="last_name">Last Name:</label>
						<input type="text" id="last_name" name="last_name" required="required"/>
					</p>
					<p>
						<label for="email">E-mail:</label>
						<input type="email" id="email" name="email" required="required"/>
					</p>
					<p>
						<label for="phone">Phone:</label>
						<input type="tel" id="phone" name="phone" required="required"/>
					</p>
					<p>
						<label for="address">Address:</label>
						<input type="text" id="address" name="address" required="required"/>
					</p>
					<p>
						<label for="city">City:</label>
						<input type="text" id="city" name="city" required="required"/>
					</p>
					<p>
						<label for="country">Country:</label>
						<input type="text" id="country" name="country" required="required"/>
					</p>
					<p>
						<label for="passport">Passport:</label>
						<input type="text" id="passport" name="passport" required="required"/>
					</p>
					
					
					<p>
						<input type="submit" name="Submit">
					</p>
				</form>
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
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
	
	$sql = "	SELECT *
				FROM BOOKING B, to_concern TC, CUSTOMER C
				WHERE B.id_booking = TC.id_booking
				AND B.id_customer = C.id_customer
				AND B.id_booking = $_GET[id];
			";
	
	$result = mysqli_query($co, $sql);
	
	$row = mysqli_fetch_array($result);
	
	$id_customer = $row['id_customer'];
	$check_in = $row['check_in_booking'];
	$check_out = $row['check_out_booking'];
	$people = $row['people_booking'];
	$status = $row['status'];
	
	$first_name = $row['first_name_customer'];
	$last_name = $row['last_name_customer'];
	$e_mail = $row['e_mail_customer'];
	$phone = $row['phone_customer'];
	$address = $row['address_customer'];
	$city = $row['city_customer'];
	$country = $row['country_customer'];
	$passport = $row['passport_customer'];
	
	
	mysqli_close($co);
?>

<!DOCTYPE>

<html>
	<head>
		<title>View booking - Charli Hotel</title>
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
			<h1>View booking</h1>
		</section>
		
		<section>
			<article class="border">
				<p>
					<a title="delete_booking" href="controller/delete_booking.php?id=<?php echo $_GET["id"] ?>">Delete
						booking</a>
				</p>
				<p>
					<a title="bill" href="bill.php?id=<?php echo $_GET['id']; ?>">Generate the bill</a>
				</p>
				<p>
					<a title="extras" href="extras.php?id=<?php echo $_GET['id']; ?>">Extras</a>
				</p>
			</article>
			<article>
				<form action="controller/edit_booking.php" method="post">
					<p>
						<input type="text" id="id_booking" name="id_booking" required="required" readonly hidden
							   value="<?php echo $_GET['id'] ?>"/>
					</p>
					<p>
						<input type="text" id="id_customer" name="id_customer" required="required" readonly hidden
							   value="<?php echo $id_customer ?>"/>
					</p>
					<p>
						<label for="check_in">Check In:</label>
						<input type="text" id="check_in" name="check_in" required="required"
							   value="<?php echo $check_in ?>"/>
					</p>
					<p>
						<label for="check_out">Check Out:</label>
						<input type="text" id="check_out" name="check_out" required="required"
							   value="<?php echo $check_out ?>"/>
					</p>
					<p>
						<label for="people">People:</label>
						<select title="people" name="people">
							<option value="<?php echo $people ?>"><?php echo $people ?></option>
							<?php
								for ($i = 1; $i <= 10; $i++)
									echo '<option value="' . $i . '">' . $i . '</option>';
							?>
						</select>
					</p>
					<p>
						<label for="status">Status:</label>
						<select title="status" name="status">
							<?php
								if ($status == 0)
									echo '<option value="' . $status . '">Booking</option>';
								else if ($status == 1)
									echo '<option value="' . $status . '">Check In</option>';
								else if ($status == 2)
									echo '<option value="' . $status . '">Check Out</option>';
							?>
							<option value="0">Booking</option>
							<option value="1">Check In</option>
							<option value="2">Check Out</option>
						</select>
					</p>
					
					<hr/>
					
					<p>
						<label for="first_name">First Name:</label>
						<input type="text" id="first_name" name="first_name" required="required"
							   value="<?php echo $first_name ?>"/>
					</p>
					<p>
						<label for="last_name">Last Name:</label>
						<input type="text" id="last_name" name="last_name" required="required"
							   value="<?php echo $last_name ?>"/>
					</p>
					<p>
						<label for="email">E-mail:</label>
						<input type="email" id="email" name="email" required="required" value="<?php echo $e_mail ?>"/>
					</p>
					<p>
						<label for="phone">Phone:</label>
						<input type="tel" id="phone" name="phone" required="required" value="<?php echo $phone ?>"/>
					</p>
					<p>
						<label for="address">Address:</label>
						<input type="text" id="address" name="address" required="required"
							   value="<?php echo $address ?>"/>
					</p>
					<p>
						<label for="city">City:</label>
						<input type="text" id="city" name="city" required="required" value="<?php echo $city ?>"/>
					</p>
					<p>
						<label for="country">Country:</label>
						<input type="text" id="country" name="country" required="required"
							   value="<?php echo $country ?>"/>
					</p>
					<p>
						<label for="passport">Passport:</label>
						<input type="text" id="passport" name="passport" required="required"
							   value="<?php echo $passport ?>"/>
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
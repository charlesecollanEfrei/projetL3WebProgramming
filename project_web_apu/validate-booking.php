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
	
	if (!empty($_POST['check_in']) &&
		!empty($_POST['check_out']) &&
		!empty($_POST['id_room']) &&
		!empty($_POST['people']) &&
		!empty($_POST['first_name']) &&
		!empty($_POST['last_name']) &&
		!empty($_POST['email']) &&
		!empty($_POST['phone']) &&
		!empty($_POST['address']) &&
		!empty($_POST['city']) &&
		!empty($_POST['country']) &&
		!empty($_POST['passport']) &&
		!empty($_POST['night']) &&
		!empty($_POST['people']) &&
		!empty($_POST['total_price'])
	) {
		
		$co = mysqli_connect("localhost", "root", "root", "hotel");
		// Check connection
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		$last_name = $_POST['last_name'];
		$passport = $_POST['passport'];
		
		$sql = "  SELECT id_customer
			  	  FROM CUSTOMER
				  WHERE last_name_customer = '$last_name'
				  AND passport_customer = '$passport'
				  ";
		
		$result = mysqli_query($co, $sql);
		
		$row = mysqli_num_rows($result);
		
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_array($result);
			$id_customer = $row['id_customer'];
		} else {
			$sql = "INSERT INTO CUSTOMER
					VALUES(
					'',
					'$_POST[first_name]',
					'$_POST[last_name]',
					'$_POST[email]',
					'$_POST[phone]',
					'$_POST[address]',
					'$_POST[city]',
					'$_POST[country]',
					'$_POST[passport]'
					)
					";
			
			mysqli_query($co, $sql) or die("Error Customer : " . mysqli_error($co));
			$id_customer = mysqli_insert_id($co);
		}
		
		$date_today = date("Y-m-d");
		
		$sql = "INSERT INTO BOOKING
				VALUE(
				'',
				'$date_today',
				'$_POST[check_in]',
				'$_POST[check_out]',
				'$_POST[people]',
			  	0,
				'$id_customer'
				)";
		
		mysqli_query($co, $sql) or die("Error Booking : " . mysqli_error($co));
		$id_booking = mysqli_insert_id($co);
		
		$sql = "INSERT INTO to_concern
				VALUE(
				'$id_booking',
				'$_POST[id_room]'
				)";
		
		mysqli_query($co, $sql) or die("Error to_concern : " . mysqli_error($co));
		
		$sql = "	SELECT name_category, floor_category, max_people_category, smoking_category
									FROM CATEGORY C, ROOM R
                                    WHERE C.id_category = R.id_category
                                    AND R.id_room = $_POST[id_room]
                                    ";
		
		
		$result = mysqli_query($co, $sql);
		
		$row = mysqli_fetch_array($result);
		
		$name_category = $row['name_category'];
		$floor_category = $row['floor_category'];
		$max_people_category = $row['max_people_category'];
		$smoking_category = $row['smoking_category'];
		
		mysqli_close($co);
		
	} else {
		header('Location: book.php');
	}

?>


<!DOCTYPE>

<html>
	<head>
		<title>Validate Booking</title>
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
				<h3>Thanks</h3>
				
				<form action="pdf.php" method="post" target=_BLANK>
					<input title="check_in" type="text" id="check_in" name="check_in" required="required" readonly
						   hidden value="<?php echo $_POST['check_in']; ?>"/>
					<input title="check_out" type="text" id="check_out" name="check_out" required="required" readonly
						   hidden value="<?php echo $_POST['check_out']; ?>"/>
					<input title="booking_number" type="text" id="booking_number" name="booking_number"
						   required="required" readonly hidden value="<?php echo $id_booking; ?>"/>
					<input title="people" type="text" id="people" name="people" required="required" readonly hidden
						   value="<?php echo $_POST['people']; ?>"/>
					<input title="first_name" type="text" id="first_name" name="first_name" required="required" readonly
						   hidden value="<?php echo $_POST['first_name']; ?>"/>
					<input title="last_name" type="text" id="last_name" name="last_name" required="required" readonly
						   hidden value="<?php echo $_POST['last_name']; ?>"/>
					<input title="email" type="text" id="email" name="email" required="required" readonly hidden
						   value="<?php echo $_POST['email']; ?>"/>
					<input title="phone" type="text" id="phone" name="phone" required="required" readonly hidden
						   value="<?php echo $_POST['phone']; ?>"/>
					<input title="address" type="text" id="address" name="address" required="required" readonly hidden
						   value="<?php echo $_POST['address']; ?>"/>
					<input title="city" type="text" id="city" name="city" required="required" readonly hidden
						   value="<?php echo $_POST['city']; ?>"/>
					<input title="country" type="text" id="country" name="country" required="required" readonly hidden
						   value="<?php echo $_POST['country']; ?>"/>
					<input title="passport" type="text" id="passport" name="passport" required="required" readonly
						   hidden value="<?php echo $_POST['passport']; ?>"/>
					<input title="name" type="text" id="name" name="name" required="required" readonly hidden
						   value="<?php echo $name_category; ?>"/>
					<input title="floor" type="text" id="floor" name="floor" required="required" readonly hidden
						   value="<?php echo $floor_category; ?>"/>
					<input title="max_people" type="text" id="max_people" name="max_people" required="required" readonly
						   hidden value="<?php echo $max_people_category; ?>"/>
					<input title="smoking" type="text" id="smoking" name="smoking" required="required" readonly hidden
						   value="<?php echo $smoking_category; ?>"/>
					<input title="number_night" type="text" id="number_night" name="number_night" required="required"
						   readonly hidden value="<?php echo $_POST['night']; ?>"/>
					<input title="total_price" type="text" id="total_price" name="total_price" required="required"
						   readonly hidden value="<?php echo $_POST['total_price']; ?>"/>
					
					<p>
						<input type="submit" name="Submit" value="Click here to show the PDF reservation">
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

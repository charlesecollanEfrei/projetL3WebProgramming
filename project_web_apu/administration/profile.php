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
	} else if ($_SESSION['job_employee'] != "administrator") {
		header('Location: home.php');
		exit;
	}
	
	$co = mysqli_connect("localhost", "root", "root", "hotel");
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	
	$sql = "	SELECT *
				FROM EMPLOYEE
				WHERE id_employee = $_GET[id]
			";
	
	$result = mysqli_query($co, $sql);
	
	$row = mysqli_fetch_array($result);
	
	$first_name_employee = $row['first_name_employee'];
	$last_name_employee = $row['last_name_employee'];
	$e_mail_employee = $row['e_mail_employee'];
	$phone_employee = $row['phone_employee'];
	$job_employee = $row['job_employee'];
	$password = $row['password'];
	
	
	mysqli_close($co);
?>

<!DOCTYPE>

<html>
	<head>
		<title>Profile - Charli Hotel</title>
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
			<h1>Employee profile</h1>
		</section>
		
		<section>
			<article>
				<p>
					<a title="delete_employee" href="controller/delete_employee.php?id=<?php echo $_GET["id"] ?>">Delete
						employee</a>
				</p>
			</article>
			<article>
				<form action="controller/edit_employee.php" method="post">
					<p>
						<input type="text" id="id" name="id" required="required" readonly hidden
							   value="<?php echo $_GET["id"] ?>"/>
					</p>
					<p>
						<label for="first_name">First Name:</label>
						<input type="text" id="first_name" name="first_name" required="required"
							   value="<?php echo $first_name_employee ?>"/>
					</p>
					<p>
						<label for="last_name">Last Name:</label>
						<input type="text" id="last_name" name="last_name" required="required"
							   value="<?php echo $last_name_employee ?>"/>
					</p>
					<p>
						<label for="email">E-mail:</label>
						<input type="email" id="email" name="email" required="required"
							   value="<?php echo $e_mail_employee ?>"/>
					</p>
					<p>
						<label for="phone">Phone:</label>
						<input type="tel" id="phone" name="phone" required="required"
							   value="<?php echo $phone_employee ?>"/>
					</p>
					<p>
						<label for="job">Job:</label>
						<select title="job" name="job">
							<option value="<?php echo $job_employee ?>" selected><?php echo $job_employee ?></option>
							<option value="receptionist">Receptionist</option>
							<option value="administrator">Administrator</option>
						</select>
					</p>
					<p>
						<label for="password">Passport:</label>
						<input type="password" id="password" name="password" required="required"
							   value="<?php echo $password ?>"/>
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
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
?>

<!DOCTYPE>

<html>
	<head>
		<title>Create employee - Charli Hotel</title>
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
			<h1>Employee Management</h1>
		</section>
		
		<section>
			<article>
				<form action="controller/create_employee.php" method="post">
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
						<label for="job">Job:</label>
						<select title="job" name="job">
							<option value="receptionist" selected>Receptionist</option>
							<option value="administrator">Administrator</option>
						</select>
					</p>
					<p>
						<label for="password">Passport:</label>
						<input type="password" id="password" name="password" required="required"/>
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
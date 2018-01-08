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

?>

<!DOCTYPE>

<html>
	<head>
		<title>Create extras - Charli Hotel</title>
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
			<h1>Create extras - Booking n° <?php echo $_GET["id"]; ?></h1>
		</section>
		
		<section>
			<article>
				<form action="controller/create_extras.php" method="post">
					<input title="id" type="text" id="id" name="id" readonly hidden value="<?php echo $_GET['id']; ?>"/>
					<p>
						<label for="name">Name:</label>
						<input type="text" id="name" name="name" required="required"/>
					</p>
					<p>
						<label for="price">Price:</label>
						<input type="text" id="price" name="price" required="required"/>
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
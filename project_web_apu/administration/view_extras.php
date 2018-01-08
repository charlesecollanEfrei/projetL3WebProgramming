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
	
	
	$sql = "	SELECT *
				FROM EXTRAS
				WHERE id_extras = '$_GET[id]';
			";
	
	$result = mysqli_query($co, $sql);
	
	$row = mysqli_fetch_array($result);
	
	$name = $row['name_extras'];
	$price = $row['price_extras'];
	
	
	mysqli_close($co);
?>

<!DOCTYPE>

<html>
	<head>
		<title>Extras - Charli Hotel</title>
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
			<h1>View extras</h1>
		</section>
		
		<section>
			<article>
				<p>
					<a title="delete_extras" href="controller/delete_extras.php?id=<?php echo $_GET["id"] ?>">Delete
						extras</a>
				</p>
			</article>
			<article>
				<form action="controller/edit_extras.php" method="post">
					<p>
						<input title="id" type="text" id="id" name="id" required="required" readonly hidden
							   value="<?php echo $_GET["id"] ?>"/>
					</p>
					<p>
						<label for="name">Name:</label>
						<input type="text" id="name" name="name" required="required" value="<?php echo $name ?>"/>
					</p>
					<p>
						<label for="price">Price:</label>
						<input type="text" id="price" name="price" required="required" value="<?php echo $price ?>"/>
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
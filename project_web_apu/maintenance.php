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
?>

<!DOCTYPE>

<html>
	<head>
		<title>Maintenance</title>
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
			<h1>Charli Hotel - Maintenance</h1>
		</section>
		
		<section>
			<article>
				<p>Booking are currently unavailable.</p>
				<p>We apologize for the inconvenience.</p>
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
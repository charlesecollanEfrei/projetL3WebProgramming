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
	
	
	$sql = "	SELECT E.id_extras, name_extras, price_extras
				FROM EXTRAS E, to_use U
				WHERE E.id_extras = U.id_extras
				AND U.id_booking = $_GET[id];
	  			";
	
	$result = mysqli_query($co, $sql) or die("Error");
	
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
			<h1>Extras - Booking n° <?php echo $_GET["id"]; ?></h1>
		</section>
		
		<section>
			<article class="border">
				<a title="create_extras" href="create_extras.php?id=<?php echo $_GET['id'] ?>">Create extras</a><br/>
				<br/>
			</article>
			
			
			<article>
				<br/>
				<table>
					<tr>
						<td><h3>Name</h3></td>
						<td><h3>Price</h3></td>
					</tr>
					
					<?php
						while ($row = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>";
							echo "<a title='view_extras' href='view_extras.php?id=" . $row['id_extras'] . "'> " . $row['name_extras'] . " </a>";
							echo "</td>";
							echo "<td>";
							echo $row['price_extras'] . " $";
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
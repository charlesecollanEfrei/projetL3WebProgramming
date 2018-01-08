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
	
	
	$sql = "	SELECT C.id_category, name_category, floor_category, max_people_category, smoking_category, price_category, COUNT(id_room) as nb
				FROM CATEGORY C LEFT OUTER JOIN ROOM R ON C.id_category = R.id_category
				GROUP BY C.id_category
				ORDER BY price_category
	  			";
	
	$result = mysqli_query($co, $sql);
	
	mysqli_close($co);

?>

<!DOCTYPE>

<html>
	<head>
		<title>Categories - Charli Hotel</title>
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
			<h1>Categories</h1>
		</section>
		
		<section>
			<article>
				<p>
					<a title="create_category" href="create_category.php">Create category</a>
				</p>
			</article>
			
			<article>
				<table>
					<tr>
						<td><h3>Name</h3></td>
						<td><h3>Floor</h3></td>
						<td><h3>Max people</h3></td>
						<td><h3>Smoking</h3></td>
						<td><h3>Price</h3></td>
						<td><h3>Number of rooms</h3></td>
					</tr>
					
					<?php
						while ($row = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>";
							echo "<a title='view_category' href='view_category.php?id=" . $row['id_category'] . "'> " . $row['name_category'] . " </a>";
							echo "</td>";
							echo "<td>";
							echo $row['floor_category'];
							echo "</td>";
							echo "<td>";
							echo $row['max_people_category'];
							echo "</td>";
							echo "<td>";
							echo $row['smoking_category'];
							echo "</td>";
							echo "<td>";
							echo $row['price_category'];
							echo "</td>";
							echo "<td>";
							echo $row['nb'];
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
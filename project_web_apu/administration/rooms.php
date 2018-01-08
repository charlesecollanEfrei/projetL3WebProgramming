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
	
	
	$sql = "	SELECT id_room, phone_room, name_category
				FROM ROOM R, CATEGORY C 
				WHERE R.id_category = C.id_category
				ORDER BY id_room
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
			<h1>Rooms</h1>
		</section>
		
		<section>
			<article>
				<p>
					<a title="create_room" href="create_room.php">Create room</a>
				</p>
			</article>
			
			<article>
				<table>
					<tr>
						<td><h3>Id</h3></td>
						<td><h3>Phone</h3></td>
						<td><h3>Category</h3></td>
					</tr>
					
					<?php
						while ($row = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>";
							echo "<a title='view_room' href='view_room.php?id=" . $row['id_room'] . "'> " . $row['id_room'] . " </a>";
							echo "</td>";
							echo "<td>";
							echo $row['phone_room'];
							echo "</td>";
							echo "<td>";
							echo $row['name_category'];
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
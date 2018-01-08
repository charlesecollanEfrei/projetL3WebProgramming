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
	
	
	$sql = "	SELECT phone_room, R.id_category, name_category
				FROM ROOM R, CATEGORY C 
				WHERE R.id_category = C.id_category
				AND id_room = $_GET[id]
			";
	
	$result = mysqli_query($co, $sql);
	
	$row = mysqli_fetch_array($result);
	
	$phone = $row['phone_room'];
	$name = $row['name_category'];
	$id_category = $row['id_category'];
	
	
	$sql = "	SELECT id_category, name_category
				FROM CATEGORY
	  			";
	
	$result = mysqli_query($co, $sql);
	
	
	mysqli_close($co);
?>

<!DOCTYPE>

<html>
	<head>
		<title>View category - Charli Hotel</title>
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
			<h1>View category</h1>
		</section>
		
		<section>
			<article>
				<form action="controller/edit_room.php" method="post">
					<p>
						<input type="text" id="id" name="id" required="required" readonly hidden
							   value="<?php echo $_GET["id"] ?>"/>
					</p>
					<p>
						<label for="phone">Phone:</label>
						<input type="tel" id="phone" name="phone" required="required" value="<?php echo $phone; ?>"/>
					</p>
					<p>
						<label for="category">Category:</label>
						<select title="category" name="category">
							<option value="<? echo $id_category; ?>" selected><? echo $name; ?></option>
							<?php
								while ($row = mysqli_fetch_array($result)) {
									echo '<option value="' . $row['id_category'] . '">' . $row['name_category'] . '</option>';
								}
							?>
						</select>
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
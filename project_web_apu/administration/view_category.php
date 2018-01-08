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
				FROM CATEGORY
				WHERE id_category = $_GET[id]
			";
	
	$result = mysqli_query($co, $sql);
	
	$row = mysqli_fetch_array($result);
	
	$name_category = $row['name_category'];
	$floor_category = $row['floor_category'];
	$max_people_category = $row['max_people_category'];
	$smoking_category = $row['smoking_category'];
	$price_category = $row['price_category'];
	
	
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
				<form action="controller/edit_category.php" method="post">
					<p>
						<input type="text" id="id" name="id" required="required" readonly hidden
							   value="<?php echo $_GET["id"] ?>"/>
					</p>
					<p>
						<label for="name">First Name:</label>
						<input type="text" id="name" name="name" required="required"
							   value="<?php echo $name_category ?>"/>
					</p>
					<p>
						<label for="floor">Floor:</label>
						<select title="floor" name="floor">
							<option value="<?php echo $floor_category ?>"><?php echo $floor_category ?></option>
							<?php
								for ($i = 1; $i <= 60; $i++)
									echo '<option value="' . $i . '">' . $i . '</option>';
							?>
						</select>
					</p>
					<p>
						<label for="max_people">Max people:</label>
						<select title="max_people" name="max_people">
							<option
								value="<?php echo $max_people_category ?>"><?php echo $max_people_category ?></option>
							<?php
								for ($i = 1; $i <= 10; $i++)
									echo '<option value="' . $i . '">' . $i . '</option>';
							?>
						</select>
					</p>
					<p>
						<label for="smoking">Smoking:</label>
						<select title="smoking" name="smoking">
							<option value="<?php echo $smoking_category ?>"><?php echo $smoking_category ?></option>
							<option value="No" selected>No</option>
							<option value="Yes">Yes</option>
						</select>
					</p>
					<p>
						<label for="price">Phone:</label>
						<input type="text" id="price" name="price" required="required"
							   value="<?php echo $price_category ?>"/>
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
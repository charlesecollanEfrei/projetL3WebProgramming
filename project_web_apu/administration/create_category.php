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
		<title>Create category - Charli Hotel</title>
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
			<h1>Create category</h1>
		</section>
		
		<section>
			<article>
				<form action="controller/create_category.php" method="post">
					<p>
						<label for="name">Name:</label>
						<input type="text" id="name" name="name" required="required"/>
					</p>
					<p>
						<label for="floor">Floor:</label>
						<select title="floor" name="floor">
							<?php
								for ($i = 1; $i <= 60; $i++)
									echo '<option value="' . $i . '">' . $i . '</option>';
							?>
						</select>
					</p>
					<p>
						<label for="max_people">Max people:</label>
						<select title="max_people" name="max_people">
							<?php
								for ($i = 1; $i <= 10; $i++)
									echo '<option value="' . $i . '">' . $i . '</option>';
							?>
						</select>
					</p>
					<p>
						<label for="smoking">Smoking:</label>
						<select title="smoking" name="smoking">
							<option value="No" selected>No</option>
							<option value="Yes">Yes</option>
						</select>
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
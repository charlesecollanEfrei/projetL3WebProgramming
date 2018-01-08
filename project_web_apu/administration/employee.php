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
	
	
	if (!empty($_GET['last_name'])) {
		$sql = "	SELECT id_employee, first_name_employee, last_name_employee, e_mail_employee, phone_employee, job_employee
									FROM EMPLOYEE
									WHERE last_name_employee LIKE '$_GET[last_name]%'
									";
	} else {
		$sql = "	SELECT id_employee, first_name_employee, last_name_employee, e_mail_employee, phone_employee, job_employee
									FROM EMPLOYEE
									";
	}
	
	$result = mysqli_query($co, $sql);
	
	mysqli_close($co);
?>

<!DOCTYPE>

<html>
	<head>
		<title>Employee Management - Charli Hotel</title>
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
				<form action="" method="get">
					
					<p>
						<label for="last_name"> Search by Last Name: </label>
						<input type="text" id="last_name" name="last_name" required="required"/>
					</p>
					
					<p>
						<input type="submit" name="Search">
					</p>
				</form>
			</article>
			
			<article>
				<p>
					<a title="create_employee" href="create_employee.php">Create employee</a>
				</p>
			</article>
			
			<article>
				<table>
					<tr>
						<td><h3>Id</h3></td>
						<td><h3>First Name</h3></td>
						<td><h3>Last Name</h3></td>
						<td><h3>Email</h3></td>
						<td><h3>Phone</h3></td>
						<td><h3>Job</h3></td>
					</tr>
					
					<?php
						while ($row = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>";
							echo "<a title='profile' href='profile.php?id=" . $row['id_employee'] . "'> " . $row['id_employee'] . " </a>";
							echo "</td>";
							echo "<td>";
							echo $row['first_name_employee'];
							echo "</td>";
							echo "<td>";
							echo $row['last_name_employee'];
							echo "</td>";
							echo "<td>";
							echo $row['e_mail_employee'];
							echo "</td>";
							echo "<td>";
							echo $row['phone_employee'];
							echo "</td>";
							echo "<td>";
							echo $row['job_employee'];
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
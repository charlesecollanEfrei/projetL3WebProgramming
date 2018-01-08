<ul>
	<li><a href="home.php">Home</a></li>
	
	<li><a href="reservations.php">Reservations</a></li>

	<?php
		if ($_SESSION['job_employee'] == "administrator") {
	echo'<li><a href="#">Rooms & Categories</a>
		<ul>
			<li><a href="rooms.php">Rooms</a></li>
			<li><a href="categories.php">Categories</a></li>
		</ul>
	</li>';
	}
	?>
	
	<?php
		if ($_SESSION['job_employee'] == "administrator") {
			echo '<li ><a href = "employee.php" > Employee</a ></li >';
		}
	?>
	
	<li><a href="controller/disconnection.php">Log out</a></li>

</ul>​
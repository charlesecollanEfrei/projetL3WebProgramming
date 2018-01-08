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

<!DOCTYPE html>
<html>
	
	
	<head>
		<title>Administration - Charli Hotel</title>
		<link href="../styles/style.css" rel="stylesheet" type="text/css">
	</head>
	
	
	<body>
		
		<section>
			
			<h1> Administration - Charli Hotel </h1>
			
			<article>
				<form method="post" action="controller/connection.php">
					<p>
						<label for="email"> Email: </label>
						<input type="text" name="email" id="email"/>
					</p>
					<p>
						<label for="password"> Password: </label>
						<input type="password" name="password" id="password"/>
					</p>
					<p>
						<input type="submit" name="submit" value="Log in"/>
					</p>
				</form>
			</article>
		
		</section>
	
	</body>


</html>
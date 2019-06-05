<?php
	if ($_SERVER['REQUEST_URI'] !== "/website/index.php")
	{
		require "header.php";
	}
?>

<head>
	<link rel="stylesheet" href="css/style"/>
</head>
<main>
	
	<h1>Signup</h1>
	<?php 
		if (isset($_GET['error']))
		{
			if ($_GET['error'] == "emptyfields")
			{
				echo '<p align=center>Fill in all fields!</p>';
			}
			
			else if ($_GET['error'] == "invaliduidmail")
			{
				echo '<p align=center>Invalid username and e-mail!</p>';
			}
			
			else if ($_GET['error'] == "invaliduid")
			{
				echo '<p align=center>Invalid username!</p>';
			}
			
			else if ($_GET['error'] == "invalidmail")
			{
				echo '<p align=center>Invalid e-mail!</p>';
			}
			
			else if ($_GET['error'] == "passwordcheck")
			{
				echo '<p align=center>Your passwords do not match!</p>';
			}
			
			else if ($_GET['error'] == "usertaken")
			{
				echo '<p align=center>User already taken!</p>';
			}
		}
		else if (isset($_GET["signup"]))
		{
			echo '<p align=center>Signup successful!</p>';
		}
	?>
	<form class="form-signup" action="includes/signup.inc.php" method="post">
		<input type="text" name="uid" placeholder="Username"><br><br>
		<input type="text" name="mail" placeholder="E-mail"><br><br>
		<input type="password" name="pwd" placeholder="Password"><br><br>
		<input type="password" name="pwd-repeat" placeholder="Repeat password"><br><br>
		<button type="submit" name="signup-submit">Signup</button>
	</form>
</main>
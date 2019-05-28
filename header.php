<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="This is an example of a meta description. This will often show up in search results.">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<title></title>
		<!--<link rel=stylesheet" href="style.css">-->
	</head>
	<body>
	
		<header>
			<nav>
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Portfolio</a></li>
					<li><a href="#">About Me</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
				<div>
					<form action="includes/login.inc.php" method="post">
						<input type="text" name="mailuid" placeholder="Username/E-mail...">
						<input type="password" name="pwd" placeholder="Password...">
						<button type="submit" name="login-submit">Login</button>
					</form>
					<a href="signup.php">Signup</a>
					<form action="includes/logout.inc.php" method="post">
						<button type="submit" name="logout-submit">Logout</button>
					</form>
				</div>
			</nav>
		</header>
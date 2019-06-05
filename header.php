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
		<link rel="stylesheet" href="css/style"/>
	</head>
	<body>
		<div class="top">
			<div class="inner-top">
				<div class="logo-container">
					<img src="images/logo.png" alt="logo">
				</div>
				<ul class="login-container">
					<?php
					if (isset($_SESSION['userId']))
					{
						echo '<form action="includes/logout.inc.php" method="post">
						<a><button type="submit" name="logout-submit">Logout</button></a>
						</form>';
					}
					else
					{
						echo '<form action="includes/login.inc.php" method="post">
						<a><input type="text" name="mailuid" placeholder="Username/E-mail"></a>
						<a><input type="password" name="pwd" placeholder="Password"></a>
						<a><button type="submit" name="login-submit">Login</button></a>
						</form>';
					}
					?>
				</ul>
			</div>
		</div>
			
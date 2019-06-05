<?php
	require "header.php";
?>

<main>
	<?php
		if (isset($_SESSION['userId']))
		{
			include("game.php");
		}
		else
		{
			include("signup.php");
		}
	?>
</main>
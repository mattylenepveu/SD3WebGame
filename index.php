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
			echo '<p>You are logged out!</p>';
		}
	?>
</main>
	
<?php
  require "footer.php";
?>
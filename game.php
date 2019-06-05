<?php
$winner = 'n';
$box = array('','','','','','','','','');
$result = 'n/a';
if (isset($_POST["submitbtn"]))
{
	$box[0] = $_POST["box0"];
	$box[1] = $_POST["box1"];
	$box[2] = $_POST["box2"];
	$box[3] = $_POST["box3"];
	$box[4] = $_POST["box4"];
	$box[5] = $_POST["box5"];
	$box[6] = $_POST["box6"];
	$box[7] = $_POST["box7"];
	$box[8] = $_POST["box8"];
	//print_r($box);
	
	if (($box[0] == 'x' && $box[1] == 'x' && $box[2] == 'x') ||
		($box[3] == 'x' && $box[4] == 'x' && $box[5] == 'x') ||
		($box[6] == 'x' && $box[7] == 'x' && $box[8] == 'x') ||
		($box[0] == 'x' && $box[4] == 'x' && $box[8] == 'x') ||
		($box[2] == 'x' && $box[4] == 'x' && $box[6] == 'x') ||
		($box[0] == 'x' && $box[3] == 'x' && $box[6] == 'x') ||
		($box[1] == 'x' && $box[4] == 'x' && $box[7] == 'x') ||
		($box[2] == 'x' && $box[5] == 'x' && $box[8] == 'x'))
	{
		$winner = 'x';
	}
	
	$blank = 0;
	for ($i=0; $i<=8; $i++)
	{
		if ($box[$i] == '')
		{
			$blank = 1;
		}
	}
	
	if ($blank == 1 && $winner == 'n')
	{
		$i = rand() % 9;
		
		while($box[$i] != '')
		{
			$i = rand() % 9;
		}
		
		$box[$i] = 'o';
		
		if (($box[0] == 'o' && $box[1] == 'o' && $box[2] == 'o') ||
			($box[3] == 'o' && $box[4] == 'o' && $box[5] == 'o') ||
			($box[6] == 'o' && $box[7] == 'o' && $box[8] == 'o') ||
			($box[0] == 'o' && $box[4] == 'o' && $box[8] == 'o') ||
			($box[2] == 'o' && $box[4] == 'o' && $box[6] == 'o') ||
			($box[0] == 'o' && $box[3] == 'o' && $box[6] == 'o') ||
			($box[1] == 'o' && $box[4] == 'o' && $box[7] == 'o') ||
			($box[2] == 'o' && $box[5] == 'o' && $box[8] == 'o'))
		{
			$winner = 'o';
		}
	}
	else if ($winner == 'n')
	{
		$winner = 't';
		
	}
}
?>
<html>
	<head>
		<title>Tic Tac Toe</title>
		<link rel="stylesheet" href="css/style"/>
	</head>
	<body bgcolor=#101010>
		<form class="form-game" name="tictactoe" method="post" action="index.php">
			<?php
			echo "<br>";
			$getvalue = $_SESSION['username'];
			
			for ($i=0; $i<=8; $i++)
			{
				printf('<input type="text" name="box%s" value="%s" id="box">', $i, $box[$i]);
				
				if ($i == 2 || $i == 5 || $i == 8)
				{
					print('<br>');
				}
			}
			
			print('<br>');
			
			// continue game
			if ($winner == 'n')
			{
				print('<input type="submit" name="submitbtn" value="Go" id="go">');
			}
			// end game
			else
			{	
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname="loginsystem";
			
				$conn = new mysqli($servername, $username, $password, $dbname);
				
				if ($conn->connect_error) 
				{
					die("Connection failed: " . $conn->connect_error);
				}
				
				$sql = "SELECT idUsers FROM users WHERE uidUsers='$getvalue'";
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) 
				{
					// output data of each row
					while($row = $result->fetch_assoc()) 
					{
						$idUsers = $row['idUsers'];
					}
				} 
				
				$conn = new mysqli($servername, $username, $password, $dbname);
				if ($conn->connect_errno) 
				{
					printf("<p>Connect failed: %s\n</p>", $con->connect_error);
					exit();
				}
				
				$sql = "SELECT gamesPlayed FROM games WHERE idUsers='$idUsers'";
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) 
				{
					while($row = $result->fetch_assoc()) 
					{
						$gamesPlayed = $row['gamesPlayed'];
					}
				}
				else
				{
					$gamesPlayed = 0;
				}
				
				$conn = new mysqli($servername, $username, $password, $dbname);
				
				if ($conn->connect_error) 
				{
					die("<p>Connection failed: </p>" . $conn->connect_error);
				}
				
				if ($gamesPlayed <= 0)
				{
					$gamesPlayed++;
					
					$sql = "INSERT INTO games (idUsers, gamesPlayed) VALUES ('$idUsers', '$gamesPlayed')";
					$result = $conn->query($sql);
					
					if (!$result)
					{
						echo "<p>Error: </p>" . $conn->error;
					}
				}
				else
				{
					$gamesPlayed++;
					$sql = "UPDATE games SET gamesPlayed = '$gamesPlayed' WHERE idUsers ='$idUsers'";
				}
				
				$conn->query($sql);
				
				$conn->close();
				
				print('<input type="button" name="newgame" value="Play Again" id="new"
						onclick="window.location.href=\'index.php\'">');
						
				if ($winner == 'x')
				{
					printf('<p align=center>X Wins!</p>');
				}
				
				else if ($winner == 'o')
				{
					printf('<p align=center>O Wins!</p>');
				}
				
				else if ($winner == 't')
				{
					printf('<p align=center>Tied Game...</p>');
				}
				
				else
				{
					printf('<p align=center>Game error...</p>');
				}
			}
			?>
		</form>
	</body>
</html>
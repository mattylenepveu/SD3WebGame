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
<style type="text/css">
body
{
	padding: 20px;
}
form
{
	margin: 0 auto;
	width: 350px;
}
#box
{
	background-color: #F6FF5E;
	border: 3px solid #F2FF00;
	width: 100px;
	height: 100px;
	font-size: 100px;
	text-align: center;
}
#go
{
	width: 350px;
	font-family: 'Comic Sans MS';
	font-size: 40px;
}
#new
{
	width: 350px;
	font-family: 'Comic Sans MS';
	font-size: 40px;
}
p
{
	color: #FFFFFF;
	font-size: 100px;
	text-align: center;
}
p2
{
	color: #FF0000;
	font-size: 10px;
	text-align: center;
}
</style>
</head>
<body bgcolor=#101010>
<form name="tictactoe" method="post" action="index.php">
<?php
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
	
	//create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	//check connection
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	}
	
	echo "Connected successfully\n";
	
	$sql = "SELECT idUsers FROM users WHERE uidUsers='$getvalue'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) 
	{
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
			echo "<p2>id: " . $row['idUsers']. "<br></p2>";
			$idUsers = $row['idUsers'];
		}
	} 
	else 
	{
		echo "<p2>0 results<p2>";
	}
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_errno) 
	{
		printf("<p2>Connect failed: %s\n</p2>", $con->connect_error);
		exit();
	}
	
	$sql = "SELECT gamesPlayed FROM games WHERE idUsers='$idUsers'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) 
	{
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
			echo "<p2>gamesPlayed: " . $row['gamesPlayed']. "<br></p2>";
			$gamesPlayed = $row['gamesPlayed'];
		}
	}
	else
	{
		$gamesPlayed = 0;
	}
	
	//create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	//check connection
	if ($conn->connect_error) 
	{
		die("<p2>Connection failed: </p2>" . $conn->connect_error);
	}
	
	//echo "Connected successfully\n";
	if ($gamesPlayed <= 0)
	{
		$gamesPlayed++;
		
		$sql = "INSERT INTO games (idUsers, gamesPlayed) VALUES ('$idUsers', '$gamesPlayed')";
		$result = $conn->query($sql);
		
		if (!$result)
		{
			echo "<p2>Error: </p2>" . $conn->error;
		}
	}
	else
	{
		$gamesPlayed++;
		
		//echo $gamesPlayed;
		$sql = "UPDATE games SET gamesPlayed = '$gamesPlayed' WHERE idUsers ='$idUsers'";
	}
	
	$conn->query($sql);
	
	/*if ($conn->query($sql) === FALSE) 
	{
		echo "<p2>Error: " . $sql . "<br></p2>" . $conn->error;
	}*/
	
	$conn->close();
	
	print('<input type="button" name="newgame" value="Play Again" id="new"
			onclick="window.location.href=\'index.php\'">');
			
	if ($winner == 'x')
	{
		printf('<p>X Wins!</p>');
	}
	
	else if ($winner == 'o')
	{
		printf('<p>O Wins!</p>');
	}
	
	else if ($winner == 't')
	{
		printf('<p>Tied Game...</p>');
	}
	
	else
	{
		printf('<p2>Game error...</p2>');
	}
}
?>
</form>
</body>
</html>
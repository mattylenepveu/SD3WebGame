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
	font-size: 100px;
	text-align: center;
}
</style>
</head>
<body bgcolor=#FFFFFF>
<form name="tictactoe" method="post" action="index.php">
<?php

//session_start(); // session start
$getvalue = $_SESSION['username']; // session get
//echo $getvalue;


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
			echo "id: " . $row['idUsers']. "<br>";
			$idUsers = $row['idUsers'];
		}
	} 
	else 
	{
		echo "0 results";
	}
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_errno) 
	{
		printf("Connect failed: %s\n", $con->connect_error);
		exit();
	}
	
	if ($result = $conn->query($sql)) 
	{
		// $result is an object and can be used to fetch row here
	}
	else 
	{
		printf("Query failed: %s\n", $conn->error);
	}
	
	
	
	$sql = "SELECT gamesPlayed FROM results WHERE idUsers='$idUsers'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) 
	{
		// output data of each row
		while($row = $result->fetch_assoc()) 
		{
			echo "gamesPlayed: " . $row['gamesPlayed']. "<br>";
			$gamesPlayed = $row['gamesPlayed'];
		}
	} 
	
	if ($gamesPlayed < 0)
	{
		$sql = "INSERT INTO results(idUsers, gamesPlayed) VALUES ('$idUsers', 0)";
		printf("why");
	}
	
	$sql = "INSERT INTO results(gamesPlayed) VALUES ($gamesPlayed++)";
	
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
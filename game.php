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
			$i = rand() % 8;
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
	width: 300px;
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
	width: 300px;
	font-family: 'Comic Sans MS';
	font-size: 40px;
}
#new
{
	width: 300px;
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
<body bgcolor="black">
<form name="tictactoe" method="post" action="game.php">
<?php
for ($i=0; $i<=8; $i++)
{
	printf('<input type="text" name="box%s" value="%s" id="box">', $i, $box[$i]);
	
	if ($i == 2 || $i == 5 || $i == 8)
	{
		print('<br>');
	}
}

print('<br>');

if ($winner == 'n')
{
	print('<input type="submit" name="submitbtn" value="Go" id="go">');
}
else
{
	print('<input type="button" name="newgame" value="Play Again" id="new"
			onclick="window.location.href=\'game.php\'">');
			
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
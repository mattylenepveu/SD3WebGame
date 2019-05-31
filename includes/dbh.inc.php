<?php

$servername = "localhost";
$dbUsername = "root";
$dBPassword = "";
$dBName = "loginsystem";

$conn = mysqli_connect($servername, $dbUsername, $dBPassword, $dBName);


if (!$conn)
{
	die("Connection failed: ".mysqli_connect_error());
}

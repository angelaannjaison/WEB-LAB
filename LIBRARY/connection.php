<?php
	$host = "localhost";
	$user = "root";
	$pwd = "";
	$db = "library";
	$conn = mysqli_connect($host, $user, $pwd, $db);
	if(!$conn)
		echo "Database connection failed!!!";
?>

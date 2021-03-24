<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	caption
	{
		caption-side: top;
		text-align: center;
	}
	button
	{
		background: #000 !important;
		font-size: 1.05vw;
		color: #fff;
		border: none;
	}
</style>
<center>
<?php
	include "connection.php";
	session_start();
	$student_id = $_SESSION['STUDENT_ID'];
	$r = mysqli_query($conn, "select STUDENT_ID from student where STUDENT_ID = $student_id");
	if(mysqli_num_rows($r))
	{
?>
		<div>
		<div class="container-fluid p-3 bg-dark text-white">e-Library</div>
		<ul class="nav nav-tabs">
			<li class="nav-item active"><a class="nav-link" data-toggle="tab" href="student_checkout.php">ISSUE A BOOK</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="student_checkin.php">RETURN A BOOK</a></li>
			<li class="nav-item"><a class="nav-link" href="logout.php">LOGOUT</a></li>
		</ul>
		<div class="tab-content">
<?php
	}
	else
		header("Location: login.php"); 
?>

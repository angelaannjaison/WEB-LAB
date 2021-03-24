<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
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
	include "../connection.php";
	session_start();
	$uid = $_SESSION['USER_ID'];
	$r = mysqli_fetch_assoc(mysqli_query($conn, "select USER_ID from login where USER_TYPE='ADMIN'"));
	if ($uid == $r["USER_ID"])
	{			
?>

		<div>
		<div class="container-fluid p-3 bg-dark text-white">e-Library</div>
		<ul class="nav nav-tabs">
			<li class="nav-item active"><a href="admin_student_approval.php" class="nav-link" data-toggle="tab">APPROVE NEW STUDENTS</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="admin_insert_book.php">INSERT BOOK</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="admin_checkin_approval.php">CHECKIN APPROVAL</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="admin_checkout_approval.php">CHECKOUT APPROVAL</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="admin_checkout_view.php">CHECKOUTS</a></li>
			<li class="nav-item"><a class="nav-link" href="../logout.php">LOGOUT</a></li>
		</ul>
		<div class="tab-content">
<?php
	}
	else
		header("Location: login.php"); 
?>
<?php
	include "connection.php";
	session_start();
	$student_id = $_SESSION['STUDENT_ID'];
	$r = mysqli_query($conn, "select STUDENT_ID from student where STUDENT_ID = $student_id");
	if(mysqli_num_rows($r))
	{
		$access_no=$_GET["access_no"];
		$sql="INSERT INTO checkout(STUDENT_ID,ACCESS_NO) VALUES($student_id,$access_no)";
		if($conn->query($sql))
			echo "<script>alert('Checkout Request sent');window.location.href='student_checkout.php';</script>";
		else
			echo "<script>alert('Checkout Request not sent');</script>";
	}
	else
		header("Location: login.php");
	mysqli_close($conn);
?>

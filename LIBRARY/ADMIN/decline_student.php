<?php
	include '../connection.php';
	session_start();   
	$uid = $_SESSION['USER_ID'];
	$r = mysqli_fetch_assoc(mysqli_query($conn, "select USER_ID from login where USER_TYPE='ADMIN'"));
	if ($uid == $r["USER_ID"])
	{
		$userID=$_GET["userID"];
		$sqldel="delete from student WHERE USER_ID=".$userID."" ;
		if(mysqli_query($conn,$sqldel))
		{
			$sqldel="delete from login WHERE USER_ID=".$userID."" ;
			if(mysqli_query($conn,$sqldel))
				echo "<script>alert('Request Declined');window.location.href='Admin_student_approval.php';</script>";
			else
				echo "<script>alert('failed to delete from login table');window.location.href='Admin_student_approval.php';</script>";
		}
		else
			echo "<script>alert('Error Occured');window.location.href='Admin_student_approval.php';</script>";
	}
	else
		echo "<script>window.location.href = '../login.php';</script>";
	mysqli_close($conn);
?>

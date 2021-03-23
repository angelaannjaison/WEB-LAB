<?php
/*---------------------------  REQUEST STATUS CHANGE   ---------------------------*/

	include '../connection.php';
	session_start();   
	$uid = $_SESSION['USER_ID'];
	$r = mysqli_fetch_assoc(mysqli_query($conn, "select USER_ID from login where USER_TYPE='ADMIN'"));
	if ($uid == $r["USER_ID"])
	{
		$studentID=$_GET["studentID"];
		$sqlchg="update student set APPROVAL_STATUS='Y' WHERE STUDENT_ID=".$studentID."" ;
		if(mysqli_query($conn,$sqlchg))
			echo "<script>alert('Student Approved');window.location.href='Admin_student_approval.php'</script>";
		else
			echo "<script>alert('Error in accepting request');window.location.href='Admin_student_approval.php'</script>";
	}
	else
		echo "<script>window.location.href = '../login.php';</script>";
	mysqli_close($conn);
?>
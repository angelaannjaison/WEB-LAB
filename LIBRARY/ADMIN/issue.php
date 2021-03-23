<?php
	include "../connection.php";
	session_start();   
	$uid = $_SESSION['USER_ID'];
	$r = mysqli_fetch_assoc(mysqli_query($conn, "select USER_ID from login where USER_TYPE='ADMIN'"));
	if ($uid == $r["USER_ID"])
	{
		$checkout_ID=$_POST["checkout_id"];
		$access_no=$_POST["access_no"];
		$issuedate=$_POST["issuedate"];
		$duedate=$_POST["duedate"];
		$sql="UPDATE checkout SET DUE='$duedate',ISSUE_DATE='$issuedate' WHERE ID=$checkout_ID";
		if($conn->query($sql))
		{
			$sql1="UPDATE book SET STATUS='OUT' WHERE ACCESS_NO=$access_no";
			if($conn->query($sql1))
				echo "<script>alert('Book Checked Out');window.location.href='admin_issue_book.php';</script>";
			else
				echo "<script>alert('book status updation failed');window.location.href='admin_issue_book.php';</script>";
		}
		else
			echo "<script>alert('checkout failed');window.location.href='admin_issue_book.php';</script>";
	}
	else
		echo "<script>window.location.href = '../login.php';</script>";
	mysqli_close($conn);
?>

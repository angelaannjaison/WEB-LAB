<html>
<head>
<title>Index Page</title></head>
<body>
	<?php
		include "../connection.php";
		session_start();
		$uid = $_SESSION['USER_ID'];
		$r = mysqli_fetch_assoc(mysqli_query($conn, "select USER_ID from login where USER_TYPE='ADMIN'"));
		if ($uid == $r["USER_ID"])
		{			
	?>
			<a href="admin_student_approval.php" target="frame1">APPROVE NEW STUDENTS</a>
			<a href="admin_insert_book.php" target="frame1">INSERT BOOK</a>
			<a href="admin_checkin_approval.php" target="frame1">CHECKIN APPROVAL</a>
			<a href="admin_issue_book.php" target="frame1">CHECKOUT APPROVAL</a>
			<a href="admin_checkouts.php" target="frame1">CHECKOUTS</a>
			<a href="../logout.php" >LOGOUT</a>
			<iframe name="frame1" width="100%" height="80%"  src="Admin_student_approval.php"></iframe></body></html>
<?php	}
		else
			echo "<script>window.location.href = '../login.php';</script>";
		mysqli_close($conn);
?>

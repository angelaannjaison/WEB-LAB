<html>
<head>
<title>Index Page</title></head>
<body>
	<?php
		include "connection.php";
		session_start();
		$student_id = $_SESSION['STUDENT_ID'];
		$r = mysqli_query($conn, "select STUDENT_ID from student where STUDENT_ID = $student_id");
		if(mysqli_num_rows($r))
		{
	?>
			<a href="student_checkin.php" target="frame1">CHECKIN</a>
			<a href="student_checkout.php" target="frame1">CHECKOUT</a>
			<a href="logout.php">LOGOUT</a>
			<iframe name="frame1" width="100%" height="80%" src="student_checkin.php"></iframe>
	<?php
		}
		else
			header("Location: login.php");
		mysqli_close($conn);
	?>
</body>
</html>


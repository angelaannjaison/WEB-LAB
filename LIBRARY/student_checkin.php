<center>
<?php
	include "connection.php";
	session_start();
	$student_id = $_SESSION['STUDENT_ID'];
	$r = mysqli_query($conn, "select STUDENT_ID from student where STUDENT_ID = $student_id");
	if(mysqli_num_rows($r))
	{
		echo "<h1>RETURN BOOK(STUDENT)</h1>";
		if(isset($_POST['checkinbtn']))//If student requests for check in
		{
			$checkout_id = $_POST['checkinbtn'];
			//inserting values to check in table
			$sql = mysqli_query($conn, "insert into checkin values(NULL, $checkout_id, 'N')");
		}
		//Getting the information of currently issued book by the correponding student
		$result1 = mysqli_query($conn, "select * from checkout where STUDENT_ID = $student_id and DUE IS NOT NULL and RETURN_STATUS='N'");

		if (mysqli_num_rows($result1))
		{
			//Submitting to same page
			echo "<form name='checkin_frm' action='student_checkin.php' method='post'>
				<table border=1><tr><th>BOOK NAME</th><th>DUE DATE</th><th>ISSUE DATE</th><th></th></tr>";
			while ( $row = mysqli_fetch_assoc($result1))
			{
				$access_no = $row["ACCESS_NO"];
				$row1 = mysqli_fetch_assoc(mysqli_query($conn, "select TITLE from book where ACCESS_NO=$access_no"));
				$title = $row1["TITLE"];
				echo "<tr><td>".$title."</td><td>".$row["DUE"]."</td><td>".$row["ISSUE_DATE"]."</td><td>";
				//checking if the student has already requested for checkin
				$result2 = mysqli_query($conn, "select ID from checkin where CHECKOUT_ID=".$row["ID"]);
				if(mysqli_num_rows($result2))
					echo "Request sent";
				else
					echo "<button type='submit' name='checkinbtn' value='".$row["ID"]."'>CHECK IN</button>";
				echo "</td></tr>";
			}
			echo "</table></form>";
		}
		else
			echo "<h3>You have no books to return!!!</h3>";	
	}
	else
		header("Location: login.php");
	mysqli_close($conn);
?>
</center>
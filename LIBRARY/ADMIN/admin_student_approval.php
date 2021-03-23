<?php
	include "../connection.php";
	/*---------------------------  DISPLAY    ---------------------------*/
	session_start();
	$uid = $_SESSION['USER_ID'];
	$r = mysqli_fetch_assoc(mysqli_query($conn, "select USER_ID from login where USER_TYPE='ADMIN'"));
	if ($uid == $r["USER_ID"])
	{
		$sqldis="select * from student";
		$result=mysqli_query($conn,$sqldis);
		if(mysqli_num_rows($result))
		{
			echo '<center>
			<table>
				<caption><h1>REGISTERED STUDENTS</h1></caption>
				<tr>
					<th>STUDENT_ID</th>
					<th>USER_ID</th>
					<th>NAME</th>
					<th>COURSE</th>
					<th>YEAR OF STUDY</th>
					<th colspan="2">ACTION</th>
				</tr>';
			while($row=mysqli_fetch_assoc($result))
			{
				$studentID=$row["STUDENT_ID"];
				$userID=$row["USER_ID"];
				echo '<tr><td>'.$row["STUDENT_ID"].'</td><td>'.$row["USER_ID"].'</td><td>'.$row["NAME"].'</td><td>'.$row["COURSE"].'</td><td>'.$row["YEAR"].'</td><th>';
				if($row["APPROVAL_STATUS"] == 'N')
					echo "<a href='approve_students.php?studentID=$studentID'><input type='button'  value='Approve' name='approve' ></a>
						</th>
						<th>
							<a href='decline_student.php?userID=$userID'><input type='button'  value='Decline' name='decline' ></a>
						</th></tr>";
				else
					echo "Approved";
			}
			echo '</table></center>';
		}
		else
			echo "<h2>No registered students!!!</h2>";
	}
	else
		echo "<script>window.location.href = '../login.php';</script>";
	mysqli_close($conn);
?>
<?php
	/*---------------------------  DISPLAY    ---------------------------*/
	include "header.php";
	
		$sqldis="select * from student";
		$result=mysqli_query($conn,$sqldis);
		if(mysqli_num_rows($result))
		{
			echo "<table class='table table-hover'>
				<caption><h1>REGISTERED STUDENTS</h1></caption>
				<thead class='table-dark'><tr>
					<th>STUDENT_ID</th>
					<th>USER_ID</th>
					<th>NAME</th>
					<th>COURSE</th>
					<th>YEAR OF STUDY</th>
					<th colspan=2>ACTION</th>
				</tr></thead><tbody>";
			while($row=mysqli_fetch_assoc($result))
			{
				$studentID=$row["STUDENT_ID"];
				$userID=$row["USER_ID"];
				echo '<tr><td>'.$row["STUDENT_ID"].'</td><td>'.$row["USER_ID"].'</td><td>'.$row["NAME"].'</td><td>'.$row["COURSE"].'</td><td>'.$row["YEAR"].'</td><th>';
				if($row["APPROVAL_STATUS"] == 'N')
					echo "<a href='approve_students.php?studentID=$studentID'><button value='' name='approve' >APPROVE</button></a>
						</th>
						<th>
							<a href='decline_student.php?userID=$userID'><button name='decline' >DECLINE</button></a>
						</th></tr>";
				else
					echo "Approved";
			}
			echo '</tbody></table>';
		}
		else
			echo "<h2>No registered students!!!</h2>";
	mysqli_close($conn);
?>
</center>
</div>
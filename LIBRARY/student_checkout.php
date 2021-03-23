<?php
	include "connection.php";
	session_start();
	$student_id = $_SESSION['STUDENT_ID'];
	$r = mysqli_query($conn, "select STUDENT_ID from student where STUDENT_ID = $student_id");
	if(mysqli_num_rows($r))
	{
		echo "<form method='POST'><center><h2>Checkout Page</h2><input type='text' placeholder='Search By Title' value='' name='search'><input type='submit' value='Search' name='submit'></center></form>";
		if(isset($_POST["submit"]))
		{
			$search=$_POST["search"];
			$sql="SELECT * FROM book WHERE TITLE LIKE '%$search%'";
		}
		else
			$sql="SELECT * FROM book";
		$result=$conn->query($sql);
		if($result->num_rows>0)
		{
			echo "<center><table><tr><th>ACCESS NO</th><th>TITLE</th><th>AUTHOR</th><th>PUBLICATION</th><th>EDITION</th><th></th></tr>";
			while($row=$result->fetch_assoc())
			{
				$access_no=$row["ACCESS_NO"];
				$status=$row["STATUS"];
				echo "<tr>
				<td>".$row["ACCESS_NO"]."</td>
				<td>".$row["TITLE"]."</td>
				<td>".$row["AUTHOR"]."</td>
				<td>".$row["PUBLICATION"]."</td>
				<td>".$row["EDITION"]."</td>";
				$sql1="SELECT * FROM checkout WHERE STUDENT_ID=$student_id AND ACCESS_NO=$access_no AND RETURN_STATUS='N' ";
				$result1=$conn->query($sql1);
				if($result1->num_rows>0)
				{
					$row=$result1->fetch_assoc();
					if($row["DUE"]==NULL)
					echo "<td>CHECKOUT REQUEST PENDING</td></tr>";
					else
					echo "<td>CHECKED OUT</td></tr>";
				}
				else if($status=='OUT')
					echo "<td>NOT AVAILABLE</td></tr>";
				else
					echo "<td><button type='submit' value='CHECK OUT'><a href='checkout.php?access_no=$access_no'>CHECK OUT</a></button></td></tr>";
			}
			echo "</table></center>";
		}
		else
			echo "<h3>No Books to Display</h3>";
	}
	else
		header("Location: login.php");
	mysqli_close($conn);
?>

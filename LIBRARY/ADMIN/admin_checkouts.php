<?php
	include "../connection.php";
?>
<center>
	<h1>BOOK VIEW(CHECKOUTS)</h1>
<?php
	session_start();   
	$uid = $_SESSION['USER_ID'];
	$r = mysqli_fetch_assoc(mysqli_query($conn, "select USER_ID from login where USER_TYPE='ADMIN'"));
	if ($uid == $r["USER_ID"])
	{
		$sql="select STUDENT_ID, ACCESS_NO, DUE from checkout where RETURN_STATUS='N' and DUE is NOT NULL";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result))
		{
			echo '<table border="1" style="border-collapse: collapse"><tr><th>STUDENT ID</th><th>ACCESS NO</th><th>TITLE</th><th>AUTHOR</th><th>EDITION</th><th>PUBLICATION</th><th>DUE DATE</th></tr>';
			while($row=mysqli_fetch_assoc($result))
			{
				$sql = "select TITLE, AUTHOR, EDITION, PUBLICATION from book where ACCESS_NO=".$row["ACCESS_NO"];
				$result1 = mysqli_query($conn, $sql);
				$row1 = mysqli_fetch_assoc($result1);
				echo '<tr><td>'.$row["STUDENT_ID"].'</td><td>'.$row["ACCESS_NO"].'</td><td>'.$row1["TITLE"].'</td><td>'.$row1["AUTHOR"].'</td><td>'.$row1["EDITION"].'</td><td>'.$row1["PUBLICATION"].'</td><td>'.$row["DUE"].'</td><tr>';
			}
			echo '</table>';
		}
		else
		{
			echo 'No books to return!!!';
		}
	}
	else
		echo "<script>window.location.href = '../login.php';</script>";
	mysqli_close($conn);
?>
</center>
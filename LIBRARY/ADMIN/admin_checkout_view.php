<?php
	include "header.php";
	
	$sql="select STUDENT_ID, ACCESS_NO, DUE from checkout where RETURN_STATUS='N' and DUE is NOT NULL";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result))
	{
		echo "<table class='table table-hover'><caption><h1>BOOK VIEW(CHECKOUTS)</h1></caption><thead class='table-dark'><tr><th>STUDENT ID</th><th>ACCESS NO</th><th>TITLE</th><th>AUTHOR</th><th>EDITION</th><th>PUBLICATION</th><th>DUE DATE</th></tr></thead>";
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
	
	mysqli_close($conn);
?>
</center>
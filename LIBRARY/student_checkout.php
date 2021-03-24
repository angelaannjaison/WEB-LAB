<style>
	*{ margin: 0; padding: 0; }
	input[type="submit"]
	{
		background-color: #000;
		color: #fff;
		border: none;
		font-size: 110%;
		padding: 2px;
	}
</style>
<?php
	include "header.php";
		echo "<center>
				<form method='POST'>
					<table><tr><td><input type='text' class='form-control-sm'  placeholder='Search By Title' name='search'></td><td>&nbsp;</td><td>
					<input class='search' type='submit' name='submit' value='Search'></td></tr></table>
				</form></center>";
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
			echo "<table class='table table-hover'><caption><h1>CHECKOUTS PAGE</h1></caption><thead class='table-dark'><tr><th>ACCESS NO</th><th>TITLE</th><th>AUTHOR</th><th>PUBLICATION</th><th>EDITION</th><th></th></tr></thead><tbody>";
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
					echo "<td><a href='checkout.php?access_no=$access_no'><button type='submit' value='CHECK OUT'>CHECK OUT</button></a></td></tr>";
			}
			echo "</table></center>";
		}
		else
			echo "<h3>No Books to Display</h3>";
	mysqli_close($conn);
?>
</div>
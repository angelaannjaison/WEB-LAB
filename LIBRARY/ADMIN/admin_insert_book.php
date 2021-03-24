<?php
	include "header.php";
?>
<form action="admin_insert_book.php" method="post">
	<table class='table table-striped w-auto'>
		<caption><h1>ADD BOOK</h1></caption>
		<tr>
			<td>Title</td>
			<td>:</td>
			<td><input type="text" name="title" required/></td>
		</tr>
		<tr>
			<td>Author</td>
			<td>:</td>
			<td><input type="text" name="author" required/></td>
		</tr>
		<tr>
			<td>Edition</td>
			<td>:</td>
			<td>
				<select name="edition">
					<?php
						for($i=1;$i<13;$i++)
							echo '<option value='.$i.'>'.$i.'</option>';
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Publication</td>
			<td>:</td>
			<td><input type="text" name="publication" required/></td>
		</tr>
		<tr>
			<th colspan="3"><center><button name="insert">ADD BOOK</button></center></th>
		</tr>
	</table>
</form>

<?php
	if(isset($_POST["insert"]))
	{
		$title = strtoupper(trim($_POST["title"]));
		$author = strtoupper(trim($_POST["author"]));
		$edition = $_POST["edition"];
		$publication = strtoupper(trim($_POST["publication"]));
		$sql="insert into book(TITLE,AUTHOR,EDITION,PUBLICATION,STATUS) values('$title','$author',$edition,'$publication','IN')";
		if (mysqli_query($conn,$sql))
		echo '<script>alert("Book Inserted!");</script>';
	}
	$result=mysqli_query($conn,"select * from book");
	if(mysqli_num_rows($result)>0)
	{
		echo "<table class='table table-hover'><caption><h1>AVAILABLE BOOKS</h1></caption><tr><thead class='table-dark'><th>BOOK ACCESS NO</th><th>BOOK TITLE</th><th>AUTHOR</th><th>EDITION</th><th>PUBLICATION</th><th>BOOK STATUS</th><th>ACTION</th></tr></thead>";
		while($row=mysqli_fetch_assoc($result))
		{
			echo '<tr><td>'.$row["ACCESS_NO"].'</td><td>'.$row["TITLE"].'</td><td>'.$row["AUTHOR"].'</td><td>'.$row["EDITION"].'</td><td>'.$row["PUBLICATION"].'</td><td>'.$row["STATUS"].'</td><th><form action="admin_insert_book.php" method="post"><button type="submit" name="delete" value='.$row["ACCESS_NO"].' onclick="return confirm(`Are you sure you want to delete this book?`);">DELETE</button></form></th><tr>';
		}
		echo '</table>';
	}
	else
	{
		echo 'Sorry!!! No books!!!';
	}

//when clicking on delete button
	if(isset($_POST["delete"]))
	{
		$access_no = $_POST["delete"];
		if(mysqli_num_rows(mysqli_query($conn, "select ID from checkout where ACCESS_NO=$access_no and RETURN_STATUS='N'")))
		{
			echo "<script>alert('Sorry!!!This book can\'t be deleted!!!');
			header('Location: admin_insert_book.php');</script>";
		}
		else
		{
			mysqli_query($conn, "delete from book where ACCESS_NO=$access_no");
			echo "<script>alert('Book $access_no deleted');
			window.location.href = 'admin_insert_book.php');</script>";
		}
	}
mysqli_close($conn);
?>
</center>
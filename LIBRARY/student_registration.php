<?php
	include "connection.php";
	
?>
<html>
<head>
<title>Library Management System</title></head><body>
		<h1>STUDENT REGISTRATION</h1>
		<form action="student_registration.php" method="post">
			<table>
				<tr>
					<td>Enter User ID</td>
					<td>:</td>
					<td><input type="number" name="user_id"/></td>
				</tr>
				<tr>
					<td>Enter Student Name</td>
					<td>:</td>
					<td><input type="text" name="name"/></td>
				</tr>
				<tr>
					<td>Course</td>
					<td>:</td>
					<td>
						<select name="course">
							<option value="BCA">BCA</option>
							<option value="MCA">MCA</option>
							<option value="BTech">BTech</option>
							<option value="MTech">MTech</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>year of study</td>
					<td>:</td>
					<td>
						<select name="year">
							<?php
								for($i = 1; $i < 5; $i++)
									echo '<option value='.$i.'>'.$i.'</option>';
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Password</td>
					<td>:</td>
					<td><input type="password" name="pwd"></td>
				</tr>
				<tr>
					<td>Confirm password</td>
					<td>:</td>
					<td><input type="password" name="confirm pwd"></td>
				</tr>
				<tr>
					<td colspan="2"><button name="submit">REGISTER</button></td>
				</tr>
			</table>
		</form>
</body></html>
		<?php
			include "connection.php";
			if(isset($_POST["submit"]))
			{
				$user_id=$_POST["user_id"];
				$name=$_POST["name"];
				$course=$_POST["course"];
				$year=$_POST["year"];
				$pass=$_POST["pwd"];
				$sql="insert into login(USER_ID,PASSWORD,USER_TYPE) values($user_id,'$pass','STUDENT')";
				if (mysqli_query($conn,$sql))
				{
					$sql1 = "insert into student(USER_ID,NAME,COURSE,YEAR) values ($user_id,'$name','$course',$year)";
					if (mysqli_query($conn, $sql1))
					{
						echo '<script>
						alert("Registration Successful");
						window.location.href="login.php";
						</script>';
					}
					else
						echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
				}
			}
			mysqli_close($conn);
	?>


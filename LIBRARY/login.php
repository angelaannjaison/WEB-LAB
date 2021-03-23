<html>
	<head>
	</head>
	<body><center>
		<form action="" method="POST">
			<table>
				<caption><h1>LOGIN</h1></caption>
				<tr>
					<td>USER ID<font color="red">*</font></td>
					<td>:</td>
					<td><input type="number" name="user" size="10" required>
					</td>
				</tr>
				<tr>
					<td>PASSWORD<font color="red">*</font></td>
					<td>:</td>
					<td><input type="password" name="pwd" maxlength="8" required></input></td>
				</tr>
				<tr>
					<td>USER TYPE<font color="red">*</font></td>
					<td>:</td>
					<td>
						<select name="type">
							<option value="ADMIN" checked>Admin</option>
							<option value="STUDENT">Student</option>
						</select>
					</td>
				</tr>
				<tr>
					<th colspan="3"><input type="submit" value="LOGIN" name="submit"></th>
				</tr>
				<tr><th colspan="3"><a href="student_registration.php">Not Yet Registered? Register Now</a></th></tr>
			</table>
		</form>

		<?php
			session_start();
			include "connection.php";
			if(isset($_POST['submit']))
			{
				$userid=$_POST['user'];
				$password=$_POST['pwd'];
				$usertype=$_POST['type'];
				$query = mysqli_query($conn,"SELECT * FROM login WHERE USER_ID ='$userid' AND PASSWORD='$password' AND USER_TYPE='$usertype'");
				$count = mysqli_num_rows($query);
				if($count == 1)
				{
					$_SESSION['USER_ID'] = $userid;
					if($usertype=='ADMIN')
						header("location:ADMIN/admin_home.php");
					else
					{
						$sql="select * from student where USER_ID='$userid'";
						$result=mysqli_query($conn,$sql);
						if(mysqli_num_rows($result))
						{
							while($row=mysqli_fetch_assoc($result))
							{
								if($row["APPROVAL_STATUS"]=='Y')
								{
									$_SESSION['STUDENT_ID'] = $row["STUDENT_ID"];
									header("location:student_home.php");
								}
								else
									echo "<script>alert('Student not approved by Admin');</script>";
							}
						}
					}
				}
				else
					echo "<script>alert('Invalid Login credentials');</script>";
			}
			mysqli_close($conn);
		?>
	</center></body>
</html>

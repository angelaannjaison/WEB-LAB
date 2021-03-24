<html>
	<head>
		<title>User Login</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	<body>
		<div class="global-container">
			<div class="card login-form">
				<div class="card-body">
					<h1 class="card-title text-center">LOGIN</h1>
					<div class="card-text">
						<form action="" method="POST">
							<div class="form-group">
								<label for="inputid">User ID</label>
								<input type="number" class="form-control form-control-sm" name="user" required>
							</div>
							<div class="form-group">
								<label for="inputpass">Password</label>
								<input type="password" class="form-control form-control-sm" name="pwd" required>
							</div>
							<div class="form-group">
								<label for="inputtype">User Type</label>
								<select name="type"  class="form-select form-select-sm" required>
									<option value="ADMIN">Admin</option>
									<option value="STUDENT">Student</option>
								</select>
							</div>
							<button type="submit" class="btn btn-dark  w-100" value="LOGIN" name="submit">LOGIN</button>
							<div class="signup">
								Not Yet Registered? <a href="student_registration.php">Register Now</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>		
		<?php
			session_start();
			include "connection.php";
			if(isset($_POST['submit']))
			{
				$userid=$_POST['user'];
				$password=$_POST['pwd'];
				$usertype=$_POST['type'];
				$query = mysqli_query($conn,"SELECT * FROM login WHERE USER_ID ='$userid' AND USER_TYPE='$usertype'");
				$r = mysqli_fetch_assoc($query);
				$count = mysqli_num_rows($query);
				if(($count == 1)&&($password===$r["PASSWORD"]))
				{
					$_SESSION['USER_ID'] = $userid;
					if($usertype==='ADMIN')
						header("location:ADMIN/header.php");
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
									header("location:header.php");
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

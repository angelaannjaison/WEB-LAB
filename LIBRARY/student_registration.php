<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="main.css">
<?php
	include "connection.php";
?>
<div class="global-container">
	<div class="card registration-form">
		<div class="card-body">
			<h1 class="card-title text-center" style="padding-right: 20px; padding-left: 20px;">STUDENT REGISTRATION</h1>
			<div class="card-text">
				<form action="student_registration.php" method="post">
					<div class="form-group">
						<label for="inputid">Enter User ID</label>
						<input type="number" class="form-control form-control-sm" name="user_id" required>
					</div>
					<div class="form-group">
						<label for="inputid">Enter Student Name</label>
						<input type="text" name="name" class="form-control form-control-sm" required>
					</div>
					<div class="form-group">
						
						<label for="inputcourse">Course</label>
						<select name="course"  class="form-select form-select-sm" required>
							<option value="BCA">BCA</option>
							<option value="MCA">MCA</option>
							<option value="BTech">BTech</option>
							<option value="MTech">MTech</option>
						</select>
					</div>
					<div class="form-group">
						<label for="inputyr">Year of study</label>
						<select name="year"  class="form-select form-select-sm" required>
							<?php
								for($i = 1; $i < 5; $i++)
									echo '<option value='.$i.'>'.$i.'</option>';
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="inputpwd">Enter Password</label>
						<input type="password" name="pwd" class="form-control form-control-sm" required>
					</div>
					<div class="form-group">
						<label for="cpwd">Confirm password</label>
						<input type="password" name="cpwd" class="form-control form-control-sm" required>
					</div>
					<button type="submit" class="btn btn-dark  w-100" value="LOGIN" name="submit">REGISTER</button>
					<div class="signup">
						<a href="login.php">Go back to login</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
		include "connection.php";
		if(isset($_POST["submit"]))
		{
			$user_id = $_POST["user_id"];
			$name = $_POST["name"];
			$course = $_POST["course"];
			$year = $_POST["year"];
			$pass = $_POST["pwd"];
			$cpass = $_POST["cpwd"];
			if($pass === $cpass)
			{
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
			else
				echo "<script>
						alert('Registration Failed');
						window.location.href='login.php';</script>";
		}
		mysqli_close($conn);
?>

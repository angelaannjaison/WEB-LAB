<html>
<head>
</head>
<body>
<form action="dataentry.php" method="post">
<table align="center">
<tr>
<td>Rollno</td>
<td><input type="text" name="rollno"/></td>
</tr>
<tr>
<td>Name</td>
<td><input type="text" name="name"/></td>
</tr>
<tr>
<td>Gender</td>
<td><input type="radio" name="demo" value="Male">Male</input><input type="radio" name="demo" value="Female">Female</input></td>
</tr>
<tr>
<td>Mark</td>
<td><select name ="mark"><option value="select">Select</option>
<?php 
 for($i=0;$i<50;$i++)
{
 echo '<option value='.$i.'>'.$i.'</option>';
}
?>
</select>
</td>
</tr>
<tr>
<td><input type="submit" name="submit"/></td>
<td><input type="reset"/></td>
</table>
</form>
</body>
</html>
<?php
 include "connection.php";
 
if(isset($_POST["submit"]))
{
$rollno=$_POST["rollno"];

 $name=$_POST["name"];
 $gender=$_POST["demo"];
 $mark=$_POST["mark"];
$sql="insert into dataentry values($rollno,'$name','$gender',$mark)";
if (mysqli_query($conn, $sql)) {
  echo '<script>alert("New record created successfully");</script>';
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
}
?>
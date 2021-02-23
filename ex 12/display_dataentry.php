<html>
<body>
<h1 align="center"><font size="25"><u>TABLE DATA</u></font></h1>
</body>
</html>
<?php
include "connection.php"; 
$sql="select * from dataentry";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result))
{
  echo '<table border="1" style="border-collapse: collapse" align="center"><tr><th>Rollno</th><th>Name</th><th>Gender</th><th>Mark</th></tr>';
  while($row=mysqli_fetch_assoc($result))
  {
    echo '<tr><td>'.$row["roll no"].'</td><td>'.$row["name"].'</td><td>'.$row["gender"].'</td><td>'.$row["mark"].'</td><tr>';

  }
  echo '</table>';
}
else
{
  echo '<script>alert("Table is Empty");</script>';
}

?>
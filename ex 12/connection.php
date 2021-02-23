<?php
$servername="localhost";
$username="root";
$password="";
$dbname="angela";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn)
{
echo "connection failed";
}
else
{
echo '<script>alert("success");</script>';
}
?>
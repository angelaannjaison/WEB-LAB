<html>
<head>
<title>exercise 11:form validation using php</title>
</head>
<style>
body
{
background-image:url('https://img.freepik.com/free-photo/hand-painted-watercolor-background-with-sky-clouds-shape_24972-1095.jpg?size=626&ext=jpg');
background-repeat:no-repeat;
background-size:cover;
}

table
{
background-color:white;
height:60%;
width:80%;
}

.error 
{color:red;}
</style>
  
<body>
<center>
<h1>FORM VALIDATION</h1>
<form action="formvalidation.php" method="post">
<table >
<tr>
<th>NAME          :</th><td><input type="text" name="name"></input><span class="error">*required field</span></td><br><br>
</tr><tr>
<th>GENDER       :</th><td><input type="radio" value="Female" name="gender">Female
<input type="radio" value="Male" name="gender">Male
<input type="radio" value="Others" name="gender">Others<span class="error">* required field</span></td><br><br>
</tr><tr>
<th>PASSWORD     :</th><td><input type="password" name="pass"></input><span class="error">* required field</span><br><br>
</tr><tr>
<th>ADDRESS     :</th><td><textarea name="address" rows="5" cols="40"></textarea><span class="error">* required field</span><br><br>
</tr><tr>
<th>PHONE NUMBER :</th><td><input type="" name="ph"></input><span class="error">* required field</span><br><br>
</tr><tr>
<th>EMAIL        :</th><td><input type="email" name="email"></input><span class="error">* required field</span><br><br>
</tr>
<tr><td align="center" colspan="2"><input type="submit" name="submit"></input></td></tr> 

</form>
</table>
</center>
</body>
</html>

<?php

if(isset($_POST["submit"]))
{
if($_POST["name"]==""){echo '<script>alert("please enter your name");</script>';}
else if(!preg_match("/^[a-zA-Z-' ]*$/",$_POST["name"])) {echo '<script>alert("Only letters and white space allowed");</script>';}
if($_POST["pass"]==""){echo '<script>alert("please enter the password");</script>';}
if($_POST["address"]==""){echo '<script>alert("please enter your address");</script>';}
if(empty($_POST["gender"])){echo '<script>alert("please select your gender");</script>';}
if($_POST["ph"]==""){echo '<script>alert("please enter your phone number");</script>';}
else if(!ctype_digit($_POST["ph"])||strlen($_POST["ph"])!=10){echo '<script>alert("please enter valid phone number");</script>';}
if($_POST["email"]==""){echo '<script>alert("please enter email");</script>';}
}

?>






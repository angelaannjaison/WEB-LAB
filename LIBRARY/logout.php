<?php
	session_start();
	session_unset();
	session_destroy();
	echo "<script>alert(`You\'ve been logged out!!!`); window.location.href='login.php';</script>";
?>

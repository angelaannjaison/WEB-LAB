<?php
	include "header.php";
	
	$result1 = mysqli_query($conn, "select CHECKOUT_ID from checkin where APPROVAL_STATUS='N'");
	if (mysqli_num_rows($result1))
	{
		echo "<table class='table table-hover'><caption><h1>RETURN BOOKS(REQUESTS)</h1></caption><thead class='table-dark'><tr><th>STUDENT ID</th><th>ACCCESS NO:</th><th>CHECKOUT ID</th><th>BOOK NAME</th><th>DUE DATE</th><th>ISSUE DATE</th><th>RETURN DATE</th><th>ACTION</th></tr></th><tbody>";
		while ($row1 = mysqli_fetch_assoc($result1))
		{
			//Getting the details of each checkouts whose approval status is 'N'
			$result2 = mysqli_query($conn, "select * from checkout where ID = ".$row1["CHECKOUT_ID"]);
			$checkout_id = $row1["CHECKOUT_ID"];
			$row2 = mysqli_fetch_assoc($result2);
			$access_no = $row2["ACCESS_NO"];
			$title = mysqli_fetch_assoc(mysqli_query($conn, "select TITLE from book where ACCESS_NO=$access_no"));
			echo "<tr><td>".$row2["STUDENT_ID"]."</td><td>".$access_no."</td><td>".$row1["CHECKOUT_ID"]."</td><td>".$title["TITLE"]."</td><td>".$row2["DUE"]."</td><td>".$row2["ISSUE_DATE"]."</td>
			<form name='checkin_frm' action='admin_checkin_approval.php?checkout_id=$checkout_id' method='post'><td>
			<input type='date' name='return_date'></td><td>
			<button type='submit' name='actionbtn' value='APPROVE' onClick=fn('date')>APPROVE</button>
			<button type='submit' name='actionbtn' value='DECLINE'>DECLINE</button>
			</td></form></tr>";
		}
		echo "</tbody></table>";
		if (isset($_POST["actionbtn"]))
		{
			$checkout_id = $_GET["checkout_id"];
			$return_date = $_POST["return_date"];
			$actionbtn = $_POST["actionbtn"];
			if ($actionbtn=== 'APPROVE')
			{
				if($return_date == '')
					echo "<script>alert('No action taken!! For approval please input the date');</script>";
				else
				{
					mysqli_query($conn, "update checkin set APPROVAL_STATUS='Y' where CHECKOUT_ID=$checkout_id");
					mysqli_query($conn, "update checkout set RETURN_STATUS='Y', RETURN_DATE='$return_date' where ID=$checkout_id");
					$row3 = mysqli_fetch_assoc(mysqli_query($conn, "select ACCESS_NO from checkout where ID=$checkout_id"));
					$access_no = $row3["ACCESS_NO"];
					$sql = mysqli_query($conn, "update book set STATUS='IN' where ACCESS_NO=$access_no");
					echo "<script>
								window.location.href = 'admin_checkin_approval.php';
						  </script>";
				}
			}
			else
			{
				$sql = mysqli_query($conn, "delete from checkin where checkout_id=$checkout_id");
				 header('Location: admin_checkin_approval.php');
			}

			//update checkin approval status to Y and change return to n in check out and insert return date change book status to 'IN'
		}
	}
	else
		echo "Sorry!!! No check-in requests";
	mysqli_close($conn);
?>
</center></div>
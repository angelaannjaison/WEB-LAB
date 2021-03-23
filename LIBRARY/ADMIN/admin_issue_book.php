<center>
<h1>ISSUE BOOKS</h1>
<?php
    include '../connection.php';
    session_start();   
    $uid = $_SESSION['USER_ID'];
    $r = mysqli_fetch_assoc(mysqli_query($conn, "select USER_ID from login where USER_TYPE='ADMIN'"));
    if ($uid == $r["USER_ID"])
    {
        $sql="select * from book b,checkout c where b.ACCESS_NO=c.ACCESS_NO AND DUE IS NULL";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result))
        {
            echo '<table border="1" style="border-collapse: collapse;"><tr><th>STUDENT ID</th><th>ACCESS NO</th><th>TITLE</th><th>AUTHOR</th><th>PUBLICATION</th><th>EDITION</th><th>ISSUE DATE</th><th>DUE DATE</th><th></th></tr>';
            while($row=mysqli_fetch_assoc($result))
            {
                $checkout_id=$row["ID"];
                $access_no=$row["ACCESS_NO"];
                echo "<form method='POST' action='issue.php'><tr><td>".$row["STUDENT_ID"].
                "</td><td>".$row["ACCESS_NO"]."</td><td>".$row["TITLE"]."</td><td>".$row["AUTHOR"]."</td><td>".$row["PUBLICATION"]."</td><td>".$row["EDITION"]."</td><td><input type='date' name='issuedate'><input type='text' hidden name='access_no' value='$access_no'><input type='text' value='$checkout_id' hidden name='checkout_id'></td><td><input type='date' name='duedate'></td><td><input type='submit' value='ISSUE'></td><tr></form>";
            }
            echo '</table>';
        }
        else
        {
            echo '<h3>....No books!!!....</h3>';
        }
    }
    else
        header("Location: ../login.php");
    mysqli_close($conn);
?>

</table>


</form>
</center>
</body>
</html>

<?php
    include "header.php";

    $sql="select * from book b,checkout c where b.ACCESS_NO=c.ACCESS_NO AND DUE IS NULL";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result))
    {
        echo "<table class='table table-hover'><caption><h1>ISSUE BOOKS(REQUESTS)</h1></caption><thead class='table-dark'><tr><th>STUDENT ID</th><th>ACCESS NO</th><th>TITLE</th><th>AUTHOR</th><th>PUBLICATION</th><th>EDITION</th><th>ISSUE DATE</th><th>DUE DATE</th><th></th></tr></thead>";
        while($row=mysqli_fetch_assoc($result))
        {
            $checkout_id=$row["ID"];
            $access_no=$row["ACCESS_NO"];
            echo "<form method='POST' action='issue.php'><tr><td>".$row["STUDENT_ID"].
            "</td><td>".$row["ACCESS_NO"]."</td><td>".$row["TITLE"]."</td><td>".$row["AUTHOR"]."</td><td>".$row["PUBLICATION"]."</td><td>".$row["EDITION"]."</td><td><input type='date' name='issuedate'><input type='text' hidden name='access_no' value='$access_no'><input type='text' value='$checkout_id' hidden name='checkout_id'></td><td><input type='date' name='duedate'></td><td><button type='submit'>ISSUE</button></td><tr></form>";
        }
        echo '</table>';
    }
    else
    {
        echo '<h3>....No books!!!....</h3>';
    }
    mysqli_close($conn);
?>

</table>


</form>

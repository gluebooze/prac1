<?php
session_start();
    include("connection.php");
    include("functions.php");
    $subcode = $_SESSION['subcode'];



    $query = "SELECT at.usn , s.Name , at.attended from attends as at , student as s where at.usn = s.usn AND at.subcode = '$subcode'";
    $result = mysqli_query($con,$query);
    $rowcount = mysqli_num_rows($result);
    $query2 = "SELECT total_class from subject where subcode ='$subcode'";
    $result2 = mysqli_query($con,$query2);
    $data2 = mysqli_fetch_assoc($result2);
    $total_days = $data2['total_class'];




?>
<b>Total class of <?php echo $_SESSION['subname']." is ".$total_days?></b>
<form method="post">
<table border="1" align="center">
    <tr>
        <td><b>usn</b></td>
        <td><b>name</b></td>
        <td><b>attended</b></td>
        <td><b>percent(%)</b></td>

    </tr>
<?php
    for($i=1;$i<=$rowcount;$i++){
        $row = mysqli_fetch_array($result);
        $percent2 = 100 * ((float)$row["attended"]/$total_days);
?>
    <tr>
        <td><?php echo $row["usn"] ?></td>
        <td><?php echo $row["Name"] ?></td>
        <td><?php echo $row["attended"] ?></td>
        <td><?php echo round($percent2, 2) ?></td>

    </tr>
<?php
    }
 ?>
</table><br>
<a href="home.php">Go to home</a>

</form>

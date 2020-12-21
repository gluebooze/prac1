<?php
session_start();
    include("connection.php");
    include("functions.php");
    $subcode = $_SESSION['subcode'];



    $query = "SELECT at.usn , s.Name , at.attended from attends as at , student as s where at.usn = s.usn AND at.subcode = '$subcode'";
    $result = mysqli_query($con,$query);
    $rowcount = mysqli_num_rows($result);


?>
<form method="post">
<table border="1" align="center">
    <tr>
        <td><b>usn</b></td>
        <td><b>name</b></td>
        <td><b>attended</b></td>

    </tr>
<?php
    for($i=1;$i<=$rowcount;$i++){
        $row = mysqli_fetch_array($result);
?>
    <tr>
        <td><?php echo $row["usn"] ?></td>
        <td><?php echo $row["Name"] ?></td>
        <td><?php echo $row["attended"] ?></td>

    </tr>
<?php
    }
 ?>
</table><br>
<a href="home.php">Go to home</a>

</form>

<?php
session_start();
    include("connection.php");
    include("functions.php");
    //print_r($_SESSION['subname']);
    $query = "select * from student ";
    $result = mysqli_query($con,$query);
    $rowcount = mysqli_num_rows($result);
?>
<table border="1" align="center">
    <tr>
        <td><b>usn</b></td>
        <td><b>name</b></td>
        <td></td>
    </tr>
<?php
    for($i=1;$i<=$rowcount;$i++){
        $row = mysqli_fetch_array($result);
?>
    <tr>
        <td><?php echo $row["usn"] ?></td>
        <td><?php echo $row["Name"] ?></td>
    </tr>
<?php
    }
 ?>
</table>

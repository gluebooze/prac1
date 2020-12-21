<?php
session_start();
    include("connection.php");
    include("functions.php");
    $subcode = $_SESSION['subcode'];
    $sqldate = $_SESSION['date'];



    $query = "SELECT at.usn , s.Name , at.status from attendance as at , student as s where at.usn = s.usn AND at.subcode = '$subcode' AND at.date = '$sqldate'";
    $result = mysqli_query($con,$query);
    $rowcount = mysqli_num_rows($result);
    


?>
<form method="post">
<table border="1" align="center">
    <tr>
        <td><b>usn</b></td>
        <td><b>name</b></td>
        <td><b>status</b></td>

    </tr>
<?php
    for($i=1;$i<=$rowcount;$i++){
        $row = mysqli_fetch_array($result);
?>
    <tr>
        <td><?php echo $row["usn"] ?></td>
        <td><?php echo $row["Name"] ?></td>
        <td><?php if($row["status"] == 1)
                    echo "present";
                  else {
                      echo "absent";
                  }?></td>

    </tr>
<?php
    }
 ?>
</table><br>
<a href="home.php">Go to home</a>

</form>

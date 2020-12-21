<?php
session_start();
    include("connection.php");
    include("functions.php");
    $subcode = $_SESSION['subcode'];

    if(isset($_REQUEST["submit"])){
        $chk =   $_REQUEST["chk"];
        //$a = implode(",",$chk);
        //print_r($chk[0]);
        for($i =0;$i<count($chk);$i++){

            mysqli_query($con,"INSERT into attends (subcode,usn) values ('$subcode','$chk[$i]')");
        }
        header("location:home.php");
        die;

    }

    $query = "select * from student ";
    $result = mysqli_query($con,$query);
    $rowcount = mysqli_num_rows($result);


?>
<form method="post">
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
        <td> <input type="checkbox" name="chk[]" value="<?php echo $row["usn"] ?>"> </td>
    </tr>
<?php
    }
 ?>
</table>
    <input type="submit" name="submit" value="submit">
</form>

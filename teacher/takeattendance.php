<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
  <style>
      .butta{
      background-color: #008080 ;
      border-color: black;
      border-style: solid;
      color: black;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 12px;
      margin: 4px 2px;
      cursor: pointer;
      }
      .butt1{
      background-color: tomato ;
      border-color: black;
      border-style: solid;
      color: black;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 12px;
      margin: 4px 2px;
      cursor: pointer;
      }
      </style>
<?php
session_start();
    include("connection.php");
    include("functions.php");
    $subcode = $_SESSION['subcode'];

    if(isset($_REQUEST["submit"])){
        $chk =   $_REQUEST["chk"];
        //$a = implode(",",$chk);
        //print_r($chk[0]);
        $sqldate = date("Y-m-d", strtotime($_POST['date']));
        // UPDATE attends SET attended = attended + 1
        mysqli_query($con,"UPDATE subject SET total_class = total_class + 1 where subcode = '$subcode'");

        $query = "SELECT at.usn , s.Name from attends as at , student as s where at.usn = s.usn AND at.subcode = '$subcode'";
        $result = mysqli_query($con,$query);
        while($rows = $result->fetch_assoc()){
            $usn = $rows['usn'];
            if (in_array($usn, $chk))
                mysqli_query($con,"call takeatt('$subcode','$usn','$sqldate');");
                //INSERT into attendance VALUES(isubcode,iusn,idate,0);
            else {
                mysqli_query($con,"INSERT into attendance VALUES('$subcode','$usn','$sqldate',0)");
            }
        }
        header("location:home.php");
        die;
        // for($i =0;$i<$rowcount;$i++){
        //     if (in_array("$data_set[$i]", $chk))
        //         print_r($data_set[$i]);
        // }

        // for($i =0;$i<count($chk);$i++){
        //
        //     mysqli_query($con,"call takeatt('$subcode','$chk[$i]','$sqldate');");
        // }

    }


    $query = "SELECT at.usn , s.Name from attends as at , student as s where at.usn = s.usn AND at.subcode = '$subcode'";
    $result = mysqli_query($con,$query);
    $rowcount = mysqli_num_rows($result);


?>
<form method="post">
select date for attendance <br>
<input type="date" name="date" value="date"><br><br><br><br>
<table border="1" align="center">
    <tr>
        <td class="butt1"><b>usn</b></td><br><br><br><br>
        <td class="butt1"><b>name</b></td><br><br><br><br>
        <td></td>
    </tr>
<?php
    for($i=1;$i<=$rowcount;$i++){
        $row = mysqli_fetch_array($result);
?>
    <tr>
        <td class="butt1"><?php echo $row["usn"] ?></td><br><br><br><br>
        <td class="butt1"><?php echo $row["Name"] ?></td><br><br><br><br>
        <td> <input type="checkbox" name="chk[]" value="<?php echo $row["usn"] ?>"> </td>
    </tr>
<?php
    }
 ?>
</table>
    <input type="submit" name="submit" value="submit">
</form>

</body>
</html>

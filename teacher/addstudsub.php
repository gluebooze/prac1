<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
  <center>
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
        <td class="butt1"><b>usn </b></td><br><br><br><br>
        <td class="butt1"><b>name</b></td><br><br><br><br>
        <td></td>
    </tr>
<?php
    for($i=1;$i<=$rowcount;$i++){
        $row = mysqli_fetch_array($result);
?>
    <tr>
        <td><?php echo $row["usn"] ?></td><br><br><br><br>
        <td><?php echo $row["Name"] ?></td><br><br><br><br>
        <td> <input type="checkbox" name="chk[]" value="<?php echo $row["usn"] ?>"> </td>
    </tr>
<?php
    }
 ?>
</table>
    <input type="submit" name="submit" value="submit">
</form>
</center>
</body>
</html>

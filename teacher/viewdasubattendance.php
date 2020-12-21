<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
  <center>
    <style>
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
    $sqldate = $_SESSION['date'];



    $query = "SELECT at.usn , s.Name , at.status from attendance as at , student as s where at.usn = s.usn AND at.subcode = '$subcode' AND at.date = '$sqldate'";
    $result = mysqli_query($con,$query);
    $rowcount = mysqli_num_rows($result);


?>
<form method="post">
<table border="1" align="center">
    <tr>
        <td class="butt1"><b>usn</b></td><br><br><br><br>
        <td class="butt1"><b>name</b></td><br><br><br><br>
        <td class="butt1"><b>status</b></td><br><br><br><br>

    </tr>
<?php
    for($i=1;$i<=$rowcount;$i++){
        $row = mysqli_fetch_array($result);
?>
    <tr>
        <td><?php echo $row["usn"] ?></td><br><br><br><br>
        <td><?php echo $row["Name"] ?></td><br><br><br><br>
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
<a href="home.php" ><b>Go to home</a>

</form>
</center>
</body>
</html>

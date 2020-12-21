<?php
session_start();
    include("connection.php");
    include("functions.php");
    //to check correcct user enable code below
    //$user_data = check_login($con);

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted

        $usn = $_POST['usn'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        if(!empty($usn) && !empty($name)){
            $query = "INSERT into student (usn,Name,Phone) values ('$usn','$name','$phone')";
            // $query = "If Not Exists(select * from student where usn='$usn')
            //             Begin
            //             insert into student (usn,Name,Phone) values ('$usn','$name','$phone')
            //             End";
            mysqli_query($con,$query);

        }else{
            echo "please enter in correct format";
        }
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
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
        <form  method="post">

            <div class="butt1">usn</div>
            <input type="text" name="usn"><br><br><br><br>

            <div class="butt1">Name</div>
            <input type="text" name="name"><br><br><br><br>

            <div class="butt1"">Phone no</div>
            <input type="number" name="phone"><br><br><br><br>

            <input type="submit" value="Add Student"><br><br><br><br>
            <a href="home.php">Go to home</a>
        </form>
    </body>
</html>

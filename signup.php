<?php
session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted
        $username = $_POST['username'];
        $password = $_POST['password'];
        $rolename = $_POST['rolename'];
        $usn = $_POST['usn'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];


        if(!empty($username) && !empty($password) && !is_numeric($username)){

            //save to database
            $q1 = "SELECT * from login where username = '$username'";
            $result = mysqli_query($con,$q1);
            $row1 = mysqli_num_rows($result);
            if($rolename == 't'){
                $q1 = "SELECT * from teacher where eid = '$usn'";
                $result = mysqli_query($con,$q1);
                $row2 = mysqli_num_rows($result);
            }else{
                $q1 = "SELECT * from student where usn = '$usn'";
                $result = mysqli_query($con,$q1);
                $row2 = mysqli_num_rows($result);
            }
            if($row1 == 0 && $row2 == 0){
                $query1 = "INSERT into login (username,password,rolename) values ('$username','$password','$rolename')";

                mysqli_query($con,$query1);
                if($rolename == 't')
                {
                    $query2 = "INSERT into teacher (eid,name,phone) values ('$usn','$name','$phone')";
                    $query3 = "INSERT into t_login (eid,username) values ('$usn','$username')";
                }else{
                    $query2 = "INSERT into student (usn,Name,Phone) values ('$usn','$name','$phone')";
                    $query3 = "INSERT into s_login (usn,username) values ('$usn','$username')";
                }
                mysqli_query($con,$query2);
                mysqli_query($con,$query3);
                header("location: login.php");
                die;
            }else if($row1 == 0 && $rolename == 's'){
                $query1 = "INSERT into login (username,password,rolename) values ('$username','$password','$rolename')";

                mysqli_query($con,$query1);
                $query2 = "INSERT into student (usn,Name,Phone) values ('$usn','$name','$phone')";
                $query3 = "INSERT into s_login (usn,username) values ('$usn','$username')";
                mysqli_query($con,$query2);
                mysqli_query($con,$query3);
            }
            else{
                echo "user already exist!";
            }
        }
        else{
            echo "please enter some valid information!!";
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

</head>

<body style="background-color:skyblue;">
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
    <div id="box">
        <form method="post">
            <div class="butta">Signup</div><br>
            <div class="butta">Username</div>
            <input type="text" name="username"><br><br>
            <div class="butta">password</div>
            <input type="password" name="password" ><br><br>
            <select name="rolename" class="butt1">
              <option value="t">Teacher</option>
              <option value="s">Student</option>

            </select><br><br>
            <div class="butta">eid/usn</div>
            <input type="text" name="usn"><br><br>
            <div class="butta">Name</div>
            <input type="text" name="name"><br><br>
            <div class="butta"">Phone no</div>
            <input type="number" name="phone"><br><br>
            <input type="submit" value="Signup" class="butt1"><br><br>

            <a href="login.php">Click to Login</a>
        </form>

    </div>
  </center>
</body>

</html>

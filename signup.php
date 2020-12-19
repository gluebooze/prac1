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
            $q1 = "select * from login where username = '$username'";
            $result = mysqli_query($con,$q1);
            $row1 = mysqli_num_rows($result);
            if($rolename == 't'){
                $q1 = "select * from teacher where eid = '$usn'";
                $result = mysqli_query($con,$q1);
                $row2 = mysqli_num_rows($result);
            }else{
                $q1 = "select * from student where usn = '$usn'";
                $result = mysqli_query($con,$q1);
                $row2 = mysqli_num_rows($result);
            }
            if($row1 == 0 && $row2 == 0){
                $query1 = "insert into login (username,password,rolename) values ('$username','$password','$rolename')";

                mysqli_query($con,$query1);
                if($rolename == 't')
                {
                    $query2 = "insert into teacher (eid,name,phone) values ('$usn','$name','$phone')";
                    $query3 = "insert into t_login (eid,username) values ('$usn','$username')";
                }else{
                    $query2 = "insert into student (usn,Name,Phone) values ('$usn','$name','$phone')";
                    $query3 = "insert into s_login (usn,username) values ('$usn','$username')";
                }
                mysqli_query($con,$query2);
                mysqli_query($con,$query3);
                header("location: login.php");
                die;
            }else{
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

<body>
    <style type="text/css">
        #text {
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
        }

        #button {
            background-color: gray;
            /* Grey */
            width: 100px;
            border: none;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }

        #box {
            background-color: gray;
            margin: auto;
            width: 300px;
            padding: 20px;
        }
    </style>
    <div id="box">
        <form method="post">
            <div style="font-size: 25px; margin:10px;">Signup</div><br>
            <div style="font-size: 15px; margin:10px;">Username</div>
            <input type="text" name="username"><br><br>
            <div style="font-size: 15px; margin:10px;">password</div>
            <input type="password" name="password" ><br><br>
            <select name="rolename">
              <option value="t">Teacher</option>
              <option value="s">Student</option>

            </select><br><br>
            <div style="font-size: 15px; margin:10px;">eid/usn</div>
            <input type="text" name="usn"><br><br>
            <div style="font-size: 15px; margin:10px;">Name</div>
            <input type="text" name="name"><br><br>
            <div style="font-size: 15px; margin:10px;">Phone no</div>
            <input type="number" name="phone"><br><br>
            <input type="submit" value="Signup"><br><br>

            <a href="login.php">Click to Login</a>
        </form>

    </div>
</body>

</html>

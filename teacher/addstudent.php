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
        <form  method="post">

            <div style="font-size: 15px; margin:10px;">usn</div>
            <input type="text" name="usn"><br><br>

            <div style="font-size: 15px; margin:10px;">Name</div>
            <input type="text" name="name"><br><br>

            <div style="font-size: 15px; margin:10px;">Phone no</div>
            <input type="number" name="phone"><br><br>

            <input type="submit" value="Add Student"><br><br>
            <a href="home.php">Go to home</a>
        </form>
    </body>
</html>

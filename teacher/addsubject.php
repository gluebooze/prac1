<?php
session_start();
    include("connection.php");
    include("functions.php");
    //to check correcct user enable code below
    //$user_data = check_login($con);
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted

        $subcode = $_POST['subcode'];
        $name = $_POST['name'];
        $username = $_SESSION['username'];
        if(!empty($subcode) && !empty($name)){

            //checking for eid
            $query = "SELECT * from t_login where username = '$username'";
            $result = mysqli_query($con,$query);
            $user_data = mysqli_fetch_assoc($result);
            $eid = $user_data['eid'];

            //addding subject
            $query = "INSERT into subject (subcode,subname,eid) values ('$subcode','$name','$eid')";
            // $query = "If Not Exists(select * from student where usn='$usn')
            //             Begin
            //             insert into student (usn,Name,Phone) values ('$usn','$name','$phone')
            //             End";
            mysqli_query($con,$query);

        }else{
            echo "please enter in correct format";
        }
    }

    echo "hello";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <form  method="post">

            <div style="font-size: 15px; margin:10px;">Subject code</div>
            <input type="text" name="subcode"><br><br>

            <div style="font-size: 15px; margin:10px;">Name</div>
            <input type="text" name="name"><br><br>


            <input type="submit" value="Add Subject"><br><br>
            <a href="home.php">Go to home</a>
        </form>
    </body>
</html>

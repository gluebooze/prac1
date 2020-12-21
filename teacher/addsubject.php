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
        <form  method="post">

            <div class="butt1">Subject code</div>
            <input type="text" name="subcode"><br><br>

            <div class="butt1">Name</div>
            <input type="text" name="name"><br><br>


            <input type="submit" class="butta" value="Add Subject"><br><br><br><br><br><br>
            <a href="home.php" style="font-family:serif;"<b> >Go to home</a>
        </form>
      </center>
    </body>
</html>

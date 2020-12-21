<?php
session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted
        $username = $_POST['username'];
        $password = $_POST['password'];


        if(!empty($username) && !empty($password) && !is_numeric($username)){

            //read from database
            echo $username." ".$password." ";
            $query = "SELECT * from login where username = '$username' && password = '$password'";
            $result = mysqli_query($con,$query);

            $user_data = mysqli_fetch_assoc($result);
            $rows = mysqli_num_rows($result);
            echo " ".$rows." ";
            if($rows==0){
                echo "please enter some valider information!!";
            }
            else{

                $_SESSION['username'] = $user_data['username'];
                $_SESSION['rolename'] = $user_data['rolename'];
                header("location: index.php");
                die;
            }

            // if($result){
            //     print_r(mysqli_fetch_assoc($result)['password']);
            //     if($result && mysqli_num_rows($result) > 0){
            //
            //         $user_data = mysqli_fetch_assoc($result);
            //
            //         if($user_data['password'] == $password){
            //             echo"hola1";
            //             $_SESSION['username'] = $user_data['username'];
            //             $_SESSION['rolename'] = $user_data['rolename'];
            //             header("location: index.php");
            //             //die;
            //         }
            //     }
            //     echo"oohh";
            // }


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
            <div style="font-size: 20px; margin:10px;">Login</div>
            <input type="text" name="username"><br><br>
            <input type="password" name="password"><br><br>
            <input type="submit" value="Login"><br><br>
            <a href="signup.php">Click to Signup</a>
        </form>

    </div>
</body>

</html>

<?php
session_start();
    include("connection.php");
    include("functions.php");
    $tempusn = $_SESSION['usn'];
    $_SESSION['name'] = mysqli_query($con,"SELECT Name from student where usn = $tempusn")->fetch_assoc();
    //printing name via changing associative array to string
    echo "Hello ".(implode(",",($_SESSION['name'])));
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <a href="logout.php" align="right">logout</a>
        <br><br>
        view attendence <br>
        <form method="post">


        <select name="subjectname2">
            <?php

            $query1 = "SELECT subname FROM subject";
            $result = mysqli_query($con,$query1);

                while($rows = $result->fetch_assoc()){
                    $subname = $rows['subname'];
                    echo "<option value='$subname'>$subname</option>";
                }
            ?>

        </select>
        <input type="submit" name="go2" />
        </form>
        <?php
            if(isset($_POST['go2'])){
                $result3 = mysqli_query($con,"SELECT subcode from subject where subname = '$_POST[subjectname2]'");
                $rows3 = $result3->fetch_assoc();
                $_SESSION['subcode'] = $rows3['subcode'];
                //print_r($_SESSION['subname']);
                header("location:viewsubattendance.php");
                die;
            }
        ?>

        view attendence on date <br>
        <form method="post">


        <select name="subjectname3">
            <?php
            
            $query1 = "SELECT subname FROM subject";
            $result = mysqli_query($con,$query1);

                while($rows = $result->fetch_assoc()){
                    $subname = $rows['subname'];
                    echo "<option value='$subname'>$subname</option>";
                }
            ?>

        </select>
        <input type="date" name="date" value="date"><br><br>
        <input type="submit" name="go3" />
        </form>
        <?php
            if(isset($_POST['go3'])){
                $result3 = mysqli_query($con,"SELECT subcode from subject where subname = '$_POST[subjectname3]'");
                $rows3 = $result3->fetch_assoc();
                $_SESSION['subcode'] = $rows3['subcode'];
                $sqldate = date("Y-m-d", strtotime($_POST['date']));
                $_SESSION['date'] = $sqldate;
                //print_r($_SESSION['subname']);
                header("location:viewdasubattendance.php");
                die;
            }
        ?>
    </body>
</html>

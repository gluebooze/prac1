<?php
session_start();
    include("connection.php");
    include("functions.php");
    $tempeid = $_SESSION['eid'];
    $_SESSION['name'] = mysqli_query($con,"SELECT name from teacher where eid = $tempeid")->fetch_assoc();
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
        <br><br>
        <a href="addstudent.php">
            <button>Add Student</button>
        </a><br><br>
        <a href="addsubject.php">
            <button>Add Subject</button>
        </a><br><br>


        Add Student to subject <br>
        <form method="post">


        <select name="subjectname">
            <?php
            $tempeid = $_SESSION['eid'];
            $query1 = "SELECT subname FROM subject where eid = $tempeid";
            $result = mysqli_query($con,$query1);

                while($rows = $result->fetch_assoc()){
                    $subname = $rows['subname'];
                    echo "<option value='$subname'>$subname</option>";
                }
            ?>

        </select>
        <input type="submit" name="go" />
    </form><br><br>
        <?php
            if(isset($_POST['go'])){
                $result2 = mysqli_query($con,"SELECT subcode from subject where subname = '$_POST[subjectname]'");
                $rows2 = $result2->fetch_assoc();
                $_SESSION['subcode'] = $rows2['subcode'];
                //print_r($_SESSION['subname']);
                header("location:addstudsub.php");
                die;
            }
        ?>
        take attendence <br>
        <form method="post">


        <select name="subjectname1">
            <?php
            $tempeid = $_SESSION['eid'];
            $query1 = "SELECT subname FROM subject where eid = $tempeid";
            $result = mysqli_query($con,$query1);

                while($rows = $result->fetch_assoc()){
                    $subname = $rows['subname'];
                    echo "<option value='$subname'>$subname</option>";
                }
            ?>

        </select>
        <input type="submit" name="go1" />
        </form>
        <?php
            if(isset($_POST['go1'])){
                $result2 = mysqli_query($con,"SELECT subcode from subject where subname = '$_POST[subjectname1]'");
                $rows2 = $result2->fetch_assoc();
                $_SESSION['subcode'] = $rows2['subcode'];
                //print_r($_SESSION['subname']);
                header("location:takeattendance.php");
                die;
            }
        ?>

    </body>
</html>

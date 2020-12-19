<?php
session_start();
    include("connection.php");
    include("functions.php");

    echo "hello";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
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
            $query1 = "SELECT subname FROM subject";
            $result = mysqli_query($con,$query1);

                while($rows = $result->fetch_assoc()){
                    $subname = $rows['subname'];
                    echo "<option value='$subname'>$subname</option>";
                }
            ?>

        </select>
        <input type="submit" name="go" />
        </form>
        <?php
            if(isset($_POST['go'])){
                $result2 = mysqli_query($con,"select subcode from subject where subname = '$_POST[subjectname]'");
                $rows2 = $result2->fetch_assoc();
                $_SESSION['subcode'] = $rows2['subcode'];
                //print_r($_SESSION['subname']);
                header("location:addstudsub.php");
                die;
            }
        ?>

    </body>
</html>

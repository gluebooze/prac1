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
    <body style="background-color:skyblue;">
      <center>
      <style>
          .butta{
          background-color: #008080 ;
          border-color: black;
          border-style:hidden;
          color: black;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 12px;
          margin: 2px 1px;
          cursor: pointer;
          }
          .butt1{
          background-color: tomato ;
          border-color: black;
          border-style:none;
          color: black;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 12px;
          margin: 2px 1px;
          cursor: pointer;
          }
          </style>
        <a href="logout.php" align="right" class="butta"><b>logout</a>
        <br><br>
        <a href="addstudent.php">
            <button class="butta"><b>Add Student</button>
        </a><br><br>
        <a href="addsubject.php">
            <button class="butta"><b> Add Subject</button>
        </a><br><br>


        <p class="butt1"><i><b>Add Student to subject</p> <br>
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
        <p class="butt1">take attendence</p>
         <br>
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

        <p class="butt1">view attendence </p>
        <br>
        <form method="post">


        <select name="subjectname2">
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

        <p>view attendence on date </p>
        <br>
        <form method="post">


        <select name="subjectname3">
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
        <input type="date" name="date" value="date" class="butt1"><br><br>
        <input type="submit" &nbsp; name="go3" class="butt1"><br><br>
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
</center>
    </body>
</html>

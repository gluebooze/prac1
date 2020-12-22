<?php
session_start();
    include("connection.php");
    include("functions.php");
    $tempeid = $_SESSION['eid'];
    $_SESSION['name'] = mysqli_query($con,"SELECT name from teacher where eid = $tempeid")->fetch_assoc();
    //printing name via changing associative array to string

?>
<?php
    $title = 'Teacher';
    require_once('header.php');?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" ><p class="fs-5"><?php echo (implode(",",($_SESSION['name']))); ?></p>

                 <a class="btn btn-danger" style="float: right; margin-top:1%; margin-right:1%" href="logout.php" align="right">logout</a>

        </div>
    </nav>


    <br><br>
    <section class="container-fluid">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-3 form-container" style="background: linear-gradient(to top right, #ffccff 0%, #ffcc99 100%);">

                <a href="addstudent.php">
                    <button type="button" class="btn btn-primary">Add Student</button>
                </a>
                <a href="addsubject.php">
                    <button type="button" class="btn btn-primary" style="float: right">Add Subject</button>
                </a><br><br><br>


                Add Student to subject <br>
                <form method="post">


                <select class="select" name="subjectname">
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
                <button type="submit" class="btn btn-outline-success btn-sm" name="go">Submit</button>
                <!-- <input type="submit" name="go" /> -->
            </form><br>

                Take attendence <br>
                <form method="post">


                <select class="select" name="subjectname1">
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
                <button type="submit" class="btn btn-outline-success btn-sm" name="go1">Submit</button>
                <!-- <input type="submit" name="go1" /> -->
            </form><br>


                view attendence <br>
                <form method="post">
                <select class="select" name="subjectname2">
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
                <button type="submit" class="btn btn-outline-success btn-sm" name="go2">Submit</button>
                <!-- <input type="submit" name="go2" /> -->
            </form><br>


                view attendence on date <br>
                <form method="post">
                <select class="select" name="subjectname3">
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
                <input type="date" name="date" value="date">
                <button type="submit" class="btn btn-outline-success btn-sm" name="go3">Submit</button>
                <!-- <input type="submit" name="go3" /> -->
                </form>
            </section>
        </section>
    </section>


        <?php
            if(isset($_POST['go'])){
                $result2 = mysqli_query($con,"SELECT subcode from subject where subname = '$_POST[subjectname]'");
                $rows2 = $result2->fetch_assoc();
                $_SESSION['subcode'] = $rows2['subcode'];
                $_SESSION['subname'] = $_POST['subjectname'];
                //print_r($_SESSION['subname']);
                header("location:addstudsub.php");
                die;
            }
        ?>

        <?php
            if(isset($_POST['go1'])){
                $result2 = mysqli_query($con,"SELECT subcode from subject where subname = '$_POST[subjectname1]'");
                $rows2 = $result2->fetch_assoc();
                $_SESSION['subcode'] = $rows2['subcode'];
                $_SESSION['subname'] = $_POST['subjectname1'];
                //print_r($_SESSION['subname']);
                header("location:takeattendance.php");
                die;
            }
        ?>

        <?php
            if(isset($_POST['go2'])){
                $result3 = mysqli_query($con,"SELECT subcode from subject where subname = '$_POST[subjectname2]'");
                $rows3 = $result3->fetch_assoc();
                $_SESSION['subcode'] = $rows3['subcode'];
                $_SESSION['subname'] = $_POST['subjectname2'];
                //print_r($_SESSION['subname']);
                header("location:viewsubattendance.php");
                die;
            }
        ?>

        <?php
            if(isset($_POST['go3'])){
                $result3 = mysqli_query($con,"SELECT subcode from subject where subname = '$_POST[subjectname3]'");
                $rows3 = $result3->fetch_assoc();
                $_SESSION['subcode'] = $rows3['subcode'];
                $sqldate = date("Y-m-d", strtotime($_POST['date']));
                $_SESSION['date2'] = date("D, d-M-Y", strtotime($_POST['date']));
                $_SESSION['date'] = $sqldate;
                $_SESSION['subname'] = $_POST['subjectname3'];
                //print_r($_SESSION['subname']);
                header("location:viewdasubattendance.php");
                die;
            }
        ?>

<?php require_once('footer.php');?>

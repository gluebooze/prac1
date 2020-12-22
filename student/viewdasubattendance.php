<?php
session_start();
    include("connection.php");
    include("functions.php");
    $subcode = $_SESSION['subcode'];
    $sqldate = $_SESSION['date'];
    $sqldate2 = $_SESSION['date2'];
    $subname = $_SESSION['subname'];



    $query = "SELECT at.usn , s.Name , at.status from attendance as at , student as s where at.usn = s.usn AND at.subcode = '$subcode' AND at.date = '$sqldate'";
    $result = mysqli_query($con,$query);
    $rowcount = mysqli_num_rows($result);



?>
<?php
    $title = 'Take Attendance';
    require_once('header.php');?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" ><p class="fs-5 text-primary"><?php echo $subname?></p>
            <p class="fs-5 text-success"><?php echo $sqldate2  ?></p>
            <a class="btn btn-danger" style="float: right; margin-top:1%; margin-right:1%" href="home.php" align="right">Go Home</a>
        </div>
    </nav>
    <section class="container-fluid">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-3 form-container" style="background: linear-gradient(to top right, #ffccff 0%, #ffcc99 100%);">
                <form method="post">
                <table class="table table-striped table-hover table-bordered" border="1" align="center">
                    <tr>
                        <td><b>usn</b></td>
                        <td><b>name</b></td>
                        <td><b>status</b></td>

                    </tr>
                <?php
                    for($i=1;$i<=$rowcount;$i++){
                        $row = mysqli_fetch_array($result);
                ?>
                    <tr>
                        <td><?php echo $row["usn"] ?></td>
                        <td><?php echo $row["Name"] ?></td>
                        <td><?php if($row["status"] == 1)
                                    echo "Present";
                                  else {
                                      echo "Absent";
                                  }?></td>

                    </tr>
                <?php
                    }
                 ?>
                </table><br>
                <!-- <a href="home.php">Go to home</a> -->

                </form>
            </section>
        </section>
    </section>


<?php require_once('footer.php');?>

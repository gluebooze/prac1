<?php
session_start();
    include("connection.php");
    include("functions.php");
    $subcode = $_SESSION['subcode'];
    $subname = $_SESSION['subname'];



    $query = "SELECT at.usn , s.Name , at.attended from attends as at , student as s where at.usn = s.usn AND at.subcode = '$subcode'";
    $result = mysqli_query($con,$query);
    $rowcount = mysqli_num_rows($result);
    $query2 = "SELECT total_class from subject where subcode ='$subcode'";
    $result2 = mysqli_query($con,$query2);
    $data2 = mysqli_fetch_assoc($result2);
    $total_days = $data2['total_class'];




?>
<?php
    $title = 'View Attencance';
    require_once('header.php');?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" ><p class="fs-5 text-success">Total class <?php echo $total_days." days"?></p>
            <p class="fs-3 text-primary"><?php echo $subname  ?></p>
            <a class="btn btn-danger" style="float: right; margin-top:1%; margin-right:1%" href="home.php" align="right">Go Home</a>
        </div>
    </nav>
    <section class="container-fluid">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-auto form-container" style="background: linear-gradient(to top right, #ffccff 0%, #ffcc99 100%);">
                <form method="post">
                <table class="table table-striped table-hover table-bordered" border="1" align="center">
                    <tr>
                        <td><b>usn</b></td>
                        <td><b>name</b></td>
                        <td><b>attended</b></td>
                        <td><b>percent(%)</b></td>

                    </tr>
                <?php
                    for($i=1;$i<=$rowcount;$i++){
                        $row = mysqli_fetch_array($result);
                        $percent2 = 100 * ((float)$row["attended"]/$total_days);
                ?>
                    <tr>
                        <td><?php echo $row["usn"] ?></td>
                        <td><?php echo $row["Name"] ?></td>
                        <td><?php echo $row["attended"] ?></td>
                        <td><?php echo round($percent2, 2) ?></td>

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

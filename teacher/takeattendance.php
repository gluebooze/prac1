<?php
session_start();
    include("connection.php");
    include("functions.php");
    $subcode = $_SESSION['subcode'];
    $subname = $_SESSION['subname'];

    if(isset($_REQUEST["submit"])){
        $chk =   $_REQUEST["chk"];
        //$a = implode(",",$chk);
        //print_r($chk[0]);
        $sqldate = date("Y-m-d", strtotime($_POST['date']));
        // UPDATE attends SET attended = attended + 1
        mysqli_query($con,"UPDATE subject SET total_class = total_class + 1 where subcode = '$subcode'");

        $query = "SELECT at.usn , s.Name from attends as at , student as s where at.usn = s.usn AND at.subcode = '$subcode'";
        $result = mysqli_query($con,$query);
        while($rows = $result->fetch_assoc()){
            $usn = $rows['usn'];
            if (in_array($usn, $chk))
                mysqli_query($con,"call takeatt('$subcode','$usn','$sqldate');");
                //INSERT into attendance VALUES(isubcode,iusn,idate,0);
            else {
                mysqli_query($con,"INSERT into attendance VALUES('$subcode','$usn','$sqldate',0)");
            }
        }
        header("location:home.php");
        die;
        // for($i =0;$i<$rowcount;$i++){
        //     if (in_array("$data_set[$i]", $chk))
        //         print_r($data_set[$i]);
        // }

        // for($i =0;$i<count($chk);$i++){
        //
        //     mysqli_query($con,"call takeatt('$subcode','$chk[$i]','$sqldate');");
        // }

    }


    $query = "SELECT at.usn , s.Name from attends as at , student as s where at.usn = s.usn AND at.subcode = '$subcode'";
    $result = mysqli_query($con,$query);
    $rowcount = mysqli_num_rows($result);


?>
<?php
    $title = 'Take Attendance';
    require_once('header.php');?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" ><p class="fs-5 text-primary"><?php echo $subname  ?></p>

        </div>
    </nav>

    <section class="container-fluid">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-3 form-container" style="background: linear-gradient(to top right, #ffccff 0%, #ffcc99 100%);">
                <form method="post">
                select date for attendance <br>
                <input type="date" name="date" value="date"><br><br>
                <table class="table table-striped table-hover table-bordered" border="1" align="center">
                    <tr>
                        <td><b>usn</b></td>
                        <td><b>name</b></td>
                        <td></td>
                    </tr>
                <?php
                    for($i=1;$i<=$rowcount;$i++){
                        $row = mysqli_fetch_array($result);
                ?>
                    <tr>
                        <td><?php echo $row["usn"] ?></td>
                        <td><?php echo $row["Name"] ?></td>
                        <td> <input type="checkbox" name="chk[]" value="<?php echo $row["usn"] ?>"> </td>
                    </tr>
                <?php
                    }
                 ?>
                </table>
                    <input class="btn btn-success" type="submit" name="submit" value="submit">
                </form>
            </section>
        </section>
    </section>

<?php require_once('footer.php');?>

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

        $query2 = "SELECT * from student";
        $result2 = mysqli_query($con,$query2);
        while($rows2 = $result2->fetch_assoc()){
            $tempusn2 = $rows2['usn'];
            if (in_array($tempusn2, $chk))
                mysqli_query($con,"INSERT into attends (subcode,usn) values ('$subcode','$tempusn2')");
                //INSERT into attendance VALUES(isubcode,iusn,idate,0);
            else {
                mysqli_query($con,"DELETE from attends where usn = '$tempusn2' AND subcode = '$subcode'");
            }
        }

        // for($i =0;$i<count($chk);$i++){
        //
        //     mysqli_query($con,"INSERT into attends (subcode,usn) values ('$subcode','$chk[$i]')");
        // }
        header("location:home.php");
        die;

    }

    $query = "SELECT * from student ";
    $result = mysqli_query($con,$query);
    $rowcount = mysqli_num_rows($result);


?>
<?php
    $title = 'Add Student';
    require_once('header.php');?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" ><p class="fs-5 text-primary"><?php echo $subname  ?></p>
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
                        <td></td>
                    </tr>
                <?php
                    for($i=1;$i<=$rowcount;$i++){
                        $row = mysqli_fetch_array($result);
                ?>
                    <tr>
                        <td><?php echo $row["usn"] ?></td>
                        <td><?php echo $row["Name"] ?></td>
                        <td> <?php $tempusn = $row["usn"];
                                $query1 = "SELECT * from attends where subcode ='$subcode' AND usn = '$tempusn' ";
                                $result1 = mysqli_query($con,$query1);
                                $rowcount1 = mysqli_num_rows($result1);
                                if($rowcount1 == 0){?>
                                    <input class="form-check-input" type="checkbox" name="chk[]" value="<?php echo $row["usn"] ?>"> </td>
                                <?php }else{?>
                                    <input class="form-check-input" type="checkbox" name="chk[]" value="<?php echo $row["usn"] ?>" checked> </td>
                                <?php } ?>
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

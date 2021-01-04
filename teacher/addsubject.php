<?php
session_start();
    include("connection.php");
    include("functions.php");
    //to check correcct user enable code below
    //$user_data = check_login($con);
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted

        $subcode = $_POST['subcode'];
        $name = $_POST['name'];
        $username = $_SESSION['username'];
        if(!empty($subcode) && !empty($name)){

            //checking for eid
            $query = "SELECT * from t_login where username = '$username'";
            $result = mysqli_query($con,$query);
            $user_data = mysqli_fetch_assoc($result);
            $eid = $user_data['eid'];

            //addding subject
            $query = "INSERT into subject (subcode,subname,eid) values ('$subcode','$name','$eid')";
            // $query = "If Not Exists(select * from student where usn='$usn')
            //             Begin
            //             insert into student (usn,Name,Phone) values ('$usn','$name','$phone')
            //             End";
            mysqli_query($con,$query);
            ?>
            <script type="text/javascript">
                window.alert("Subject added");
            </script>
            <?php

        }else{
            echo "please enter in correct format";
        }
    }


?>
<?php
    $title = 'Add subject';
    require_once('header.php');?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" ><p class="fs-5"><?php echo (implode(",",($_SESSION['name']))); ?></p>

                 <a class="btn btn-danger" style="float: right; margin-top:1%; margin-right:1%" href="logout.php" align="right">logout</a>

        </div>
    </nav>
    <section class="container-fluid">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-3 form-container" style="background: linear-gradient(to top right, #ffccff 0%, #ffcc99 100%);">
                <form  method="post">


                    <div class="mb-3">
                      <label  class="form-label">Subject Code</label>
                      <input type="text" name="subcode" class="form-control"  aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Name</label>
                      <input type="text" name="name" class="form-control" >
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Add subject</button>
                    </div><br>
                    <!-- <input type="submit" value="Login"><br><br> -->


                    <a href="home.php">Go to home</a>




                    <!-- <div style="font-size: 15px; margin:10px;">Subject code</div>
                    <input type="text" name="subcode"><br><br>

                    <div style="font-size: 15px; margin:10px;">Name</div>
                    <input type="text" name="name"><br><br>


                    <input type="submit" value="Add Subject"><br><br>
                    <a href="home.php">Go to home</a> -->
                </form>
            </section>
        </section>
    </section>


<?php require_once('footer.php');?>

<?php
session_start();
    include("connection.php");
    include("functions.php");
    //to check correcct user enable code below
    //$user_data = check_login($con);

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted

        $usn = $_POST['usn'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        if(!empty($usn) && !empty($name)){
            $query = "INSERT into student (usn,Name,Phone) values ('$usn','$name','$phone')";
            // $query = "If Not Exists(select * from student where usn='$usn')
            //             Begin
            //             insert into student (usn,Name,Phone) values ('$usn','$name','$phone')
            //             End";
            mysqli_query($con,$query);
            ?>
            <script type="text/javascript">
                window.alert("Student added");
            </script>
            <?php
            // echo "added ".$usn." ".$name;

        }else{
            echo "please enter in correct format";
        }
    }
?>

<?php
    $title = 'Add Student';
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
                      <label  class="form-label">USN</label>
                      <input type="text" name="usn" class="form-control"  aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Name</label>
                      <input type="text" name="name" class="form-control" >
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Phone no</label>
                      <input type="number" name="phone" class="form-control" >
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Add student</button>
                    </div><br>
                    <a href="home.php">Go to home</a>


                    <!-- <div style="font-size: 15px; margin:10px;">usn</div>
                    <input type="text" name="usn"><br><br>

                    <div style="font-size: 15px; margin:10px;">Name</div>
                    <input type="text" name="name"><br><br>

                    <div style="font-size: 15px; margin:10px;">Phone no</div>
                    <input type="number" name="phone"><br><br>

                    <input type="submit" value="Add Student"><br><br>
                    <a href="home.php">Go to home</a> -->
                </form>
            </section>
        </section>
    </section>


<?php require_once('footer.php');?>

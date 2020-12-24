<?php
session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted
        $username = $_POST['username'];
        $password = $_POST['password'];
        $rolename = $_POST['rolename'];
        $usn = $_POST['usn'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];


        if(!empty($username) && !empty($password) && !is_numeric($username)){

            //save to database
            $q1 = "SELECT * from login where username = '$username'";
            $result = mysqli_query($con,$q1);
            $row1 = mysqli_num_rows($result);
            if($rolename == 't'){
                $q1 = "SELECT * from teacher where eid = '$usn'";
                $result = mysqli_query($con,$q1);
                $row2 = mysqli_num_rows($result);
            }else{
                $q1 = "SELECT * from student where usn = '$usn'";
                $result = mysqli_query($con,$q1);
                $row2 = mysqli_num_rows($result);
            }
            if($row1 == 0 && $row2 == 0){
                $query1 = "INSERT into login (username,password,rolename) values ('$username','$password','$rolename')";

                mysqli_query($con,$query1);
                if($rolename == 't')
                {
                    $query2 = "INSERT into teacher (eid,name,phone) values ('$usn','$name','$phone')";
                    $query3 = "INSERT into t_login (eid,username) values ('$usn','$username')";
                }else{
                    $query2 = "INSERT into student (usn,Name,Phone) values ('$usn','$name','$phone')";
                    $query3 = "INSERT into s_login (usn,username) values ('$usn','$username')";
                }
                mysqli_query($con,$query2);
                mysqli_query($con,$query3);
                header("location: login.php");
                die;
            }else if($row1 == 0 && $rolename == 's'){
                $query1 = "INSERT into login (username,password,rolename) values ('$username','$password','$rolename')";

                mysqli_query($con,$query1);
                $query2 = "INSERT into student (usn,Name,Phone) values ('$usn','$name','$phone')";
                $query3 = "INSERT into s_login (usn,username) values ('$usn','$username')";
                mysqli_query($con,$query2);
                mysqli_query($con,$query3);
            }
            else{

                ?>
                <script type="text/javascript">
                    window.alert("user already exists!");
                </script>
                <?php
            }
        }
        else{
            ?>
            <script type="text/javascript">
                window.alert("Please enter valid information");
            </script>
            <?php
        }
    }


?>

<?php
    $title = 'Signup';
    require_once('header.php');?>


    <section class="container-fluid">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-3" style="background: linear-gradient(to top right, #ffccff 0%, #ffcc99 100%);">
                <form method="post" class="form-container">
                    <div class="mb-1 text-center">
                      <label  class="form-label"><h5>Signup</h5></label>
                  </div>
                    <div class="mb-3">
                      <label  class="form-label">Username</label>
                      <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <select name="rolename" class="form-select" aria-label="Default select example">
                          <option value="t">Teacher</option>
                          <option value="s">Student</option>
                        </select>
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Eid/usn</label>
                      <input type="text" name="usn" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Name</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3">
                      <label  class="form-label">Phone no</label>
                      <input type="text" name="phone" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Signup</button>
                    </div><br>
                    <!-- <input type="submit" value="Login"><br><br> -->


                    <a href="login.php">Click to Login</a>
                </form>
            </section>
        </section>
    </section>

    <!-- <div id="box">
        <form method="post">
            <div style="font-size: 25px; margin:10px;">Signup</div><br>
            <div style="font-size: 15px; margin:10px;">Username</div>
            <input type="text" name="username"><br><br>
            <div style="font-size: 15px; margin:10px;">password</div>
            <input type="password" name="password" ><br><br>
            <select name="rolename" class="form-select" aria-label="Default select example">
              <option value="t">Teacher</option>
              <option value="s">Student</option>

            </select><br><br>
            <div style="font-size: 15px; margin:10px;">eid/usn</div>
            <input type="text" name="usn"><br><br>
            <div style="font-size: 15px; margin:10px;">Name</div>
            <input type="text" name="name"><br><br>
            <div style="font-size: 15px; margin:10px;">Phone no</div>
            <input type="number" name="phone"><br><br>
            <input type="submit" value="Signup"><br><br>

            <a href="login.php">Click to Login</a>
        </form>

    </div> -->

<?php require_once('footer.php');?>

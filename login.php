<?php
session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted
        $username = $_POST['username'];
        $password = $_POST['password'];


        if(!empty($username) && !empty($password) && !is_numeric($username)){

            //read from database
            echo $username." ".$password." ";
            $query = "SELECT * from login where username = '$username' && password = '$password'";
            $result = mysqli_query($con,$query);

            $user_data = mysqli_fetch_assoc($result);
            $rows = mysqli_num_rows($result);
            echo " ".$rows." ";
            if($rows==0){
                ?>
                <script type="text/javascript">
                    window.alert("Please enter valid information");
                </script>
                <?php
            }
            else{

                $_SESSION['username'] = $user_data['username'];
                $_SESSION['rolename'] = $user_data['rolename'];
                header("location: index.php");
                die;
            }

            // if($result){
            //     print_r(mysqli_fetch_assoc($result)['password']);
            //     if($result && mysqli_num_rows($result) > 0){
            //
            //         $user_data = mysqli_fetch_assoc($result);
            //
            //         if($user_data['password'] == $password){
            //             echo"hola1";
            //             $_SESSION['username'] = $user_data['username'];
            //             $_SESSION['rolename'] = $user_data['rolename'];
            //             header("location: index.php");
            //             //die;
            //         }
            //     }
            //     echo"oohh";
            // }


        }
        else{
            echo "please enter some valid information!!";
            ?>
            <script type="text/javascript">
                window.alert("Please enter valid information");
            </script>
            <?php
        }
    }
?>

<?php
    $title = 'Login';
    require_once('header.php');?>

    <section class="container-fluid">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-3" style="background: linear-gradient(to top right, #ffccff 0%, #ffcc99 100%);">
                <form method="post" class="form-container">
                    <div class="mb-1 text-center">
                      <label  class="form-label"><h5>Login</h5></label>
                  </div>
                    <div class="mb-3">
                      <label  class="form-label">Username</label>
                      <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div><br>
                    <!-- <input type="submit" value="Login"><br><br> -->


                    <a href="signup.php">Click to Signup</a>
                </form>
            </section>
        </section>
    </section>
        <!-- <form method="post">
            <div style="font-size: 20px; margin:10px;">Login</div>
            <input type="text" name="username"><br><br>
            <input type="password" name="password"><br><br>
            <input type="submit" value="Login"><br><br>
            <a href="signup.php">Click to Signup</a>
        </form> -->


<?php require_once('footer.php');?>

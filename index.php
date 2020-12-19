<?php
session_start();

  include("connection.php");
  include("functions.php");
  $user_data = check_login($con);
  if($_SESSION['rolename'] == 't'){
      $tempeid = $_SESSION['username'];
      $result = mysqli_query($con,"SELECT eid from t_login where username = '$tempeid' ")->fetch_assoc();
      $_SESSION['eid'] = $result['eid'];
      header("location: teacher/home.php");
      die;
  }
  else if($_SESSION['rolename'] == 's'){
      $tempusn = $_SESSION['username'];
      $result = mysqli_query($con,"SELECT usn from s_login where username = '$tempusn' ")->fetch_assoc();
      $_SESSION['usn'] = $result['usn'];
      header("location: student/home.php");
      die;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="logout.php">Logout</a>
    <h1>This is index page</h1>
    <br>
        Hello User.
</body>
</html>

<?php
session_start();
    include("connection.php");
    include("functions.php");
    $user_data = check_login($con);

    echo "hello";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>

    </body>
</html>

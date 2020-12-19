<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "sams1";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){

die("!!FAILED TO CONNECT!!");

}

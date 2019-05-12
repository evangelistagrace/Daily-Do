<?php

//initialize variables
$dbserver = "localhost";
$dbuser = "root";
$dbpass = "";

//create connection
$db = mysqli_connect($dbserver, $dbuser, $dbpass);
//check connection
if(!$db){
    die("connection failed: ".mysqli_connect_error());
}

?>
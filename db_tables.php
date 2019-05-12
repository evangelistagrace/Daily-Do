<?php

session_start();

require "config.php";
    
//create database
$db_selected = mysqli_select_db($db, "app");
if(!$db_selected){ //create new database if it doesn't exist
    $sql = "CREATE DATABASE app";
    if(mysqli_query($db,$sql)){ 
        
    }
    else{
        echo "error creating database: ".mysqli_error($db);
    }
}

    //sql file
    $filename = 'projectdb.sql';
    $handle = fopen($filename, "r+");
    $contents = fread($handle, filesize($filename));

    $sql = explode(';',$contents);
    foreach($sql as $query){
        $result = mysqli_query($db,$query);

    }
    fclose($handle);
?>
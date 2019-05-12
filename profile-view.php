<?php

  require "db_tables.php";
    
    //prevent user from accessing index.php before they log in
    if(!isset($_SESSION['username'])){
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
    //logout user session
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header("location: login.php");
    }

?> 


<!DOCTYPE html>
<html>
  <head>
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!--Stylesheets-->
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="hamburger-menu.css">
    <link rel="stylesheet" type="text/css" href="reminder-toggle-switch.css">

    <title>Daily-Do: Profile</title>

  </head>
  <style>
    .footer{
        position: absolute;
        bottom: 0;
    }
  </style>
  <body>
    <div class="wrapper">
      <!-- Header -->
      <?php include "header-view.php"?>
      
      <!--Page Navigation-->
      <div class="pages">

        <!--pages -->
        <section id="main">
          
            <?php if(isset($_SESSION['username'])) : ?>
                <h3 class="welcome">Welcome, <em><?php echo $_SESSION['username']; ?></em></h3>
                <h2 class="profile">Profile</h2>
                <p class="profile">
                    <img class="profileImage" src="images/profile.png">
                    <b><?php echo $_SESSION['userType']; ?></b>
                    <br>
                    Name: <?php echo $_SESSION['username']; ?>
                    <br>
                    Email: <?php echo $_SESSION['email']; ?>
                </p>
                
            <?php endif ?>        
                
            
        </section>
      </div> <!-- end of pages -->
    </div> <!--end of wrapper-->
    <?php include "footer.php" ?>
  </body>
</html>
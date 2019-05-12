<?php

require "groceries-process.php";

//initialize variables
$count_todo_grocery = array();
$count_completed_grocery = array();

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
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!--Stylesheets-->
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="hamburger-menu.css">
    <link rel="stylesheet" type="text/css" href="reminder-toggle-switch.css">
    <title>Daily-Do: Home</title>

  </head>
  <body>
    <div class="wrapper">
    <?php include "header-view.php"?>
      
      <!--Page Navigation-->
      <div class="pages">
        <!--tab button input-->
        <input id="tab1" type="radio" name="pages">
        <input id="tab2" type="radio" name="pages" checked="checked" >
        <input id="tab3" type="radio" name="pages">
        <input id="tab4" type="radio" name="pages">
        
        <!--tab menu -->
        <nav>
            <ul> 
            <li class="tab1">
                <label class="menu-btn" for="tab1"><a href="payments-view.php">Payments</a></label>
            </li>
            <li class="tab2">
            <label class="menu-btn" for="tab2"><a href="groceries-view.php">Groceries</a></label></a>
            </li>
            <li class="tab3">
                <label class="menu-btn" for="tab3"><a href="fitness-view.php">Fitness</a></label>
            </li>
            <li class="tab4">
                <label class="menu-btn" for="tab4"><a href="chores-view.php">Chores</a></label>
            </li>
            </ul>
        </nav>
        
        <!--pages -->
        <section id="main">

            <?php if(isset($_SESSION['username'])) : ?>
            <h3 class="welcome">Welcome, <em><?php echo $_SESSION['username']; ?></em></h3>
            <?php endif ?>
  
            <!--page: groceries-->
            <div class="tab2">
              <?php if (isset($_SESSION['message'])): ?>
                <div class="msg">
                  <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                  ?>
                </div>
              <?php endif ?>
              <h2 class="groceries">Shopping/Groceries</h2>
              <!-- display progress bar -->
          
            <div class="progress">
                <div id='grocery_meter'><div id='grocery_progress'></div></div>
                <div id="grocery_percentage">0%</div> 
            </div>
            <div class="fraction">
                <span id="grocery_completed">0</span>/<span id="grocery_total">0</span>
            </div>
            <br>

              <!--todo-->
              <div class="container">
                <fieldset class="todo">
                  <?php $results = mysqli_query($db, "SELECT * FROM todo_grocery t INNER JOIN parent p ON t.username = p.childUsername WHERE p.username='".$_SESSION['username']."'"); ?>
                  <legend>In Progress</legend>
                  <table>
                    <thead>
                      <tr>
                        <th>Task</th>
                      </tr>
                    </thead>
                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                      <tr>
                        <td><?php echo $row['task_grocery']; ?></td>
                      </tr>
                      <?php array_push($count_todo_grocery," ") ?>
                    <?php } ?>
                    <?php $count = count($count_todo_grocery) ?>
                    <input id="count_todo_grocery" type="hidden" value="<?php echo $count ?>">
                  </table>
                </fieldset>	
              </div>
            

            <!-- completed -->
            <div class="container">
                <fieldset class="completed">
                  <?php $results = mysqli_query($db, "SELECT * FROM completed_grocery t INNER JOIN parent p ON t.username = p.childUsername WHERE p.username='".$_SESSION['username']."'"); ?>
                  <legend>Completed</legend>
                  <table>
                    <thead>
                      <tr>
                        <th>Task</th>
                      </tr>
                    </thead>
                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                      <tr>
                        <td><?php echo $row['task_grocery']; ?></td>
                      </tr>
                      <?php array_push($count_completed_grocery," ") ?>
                    <?php } ?>
                    <?php $count = count($count_completed_grocery) ?>
                    <input id="count_completed_grocery" type="hidden" value="<?php echo $count ?>">
                  </table>
                </fieldset>
              </div>
              
            </div> <!--end of groceries-->
          </section>
        </div> <!--end of page-->
        <?php include "footer.php" ?>
    </div><!--end of wrapper -->
    <script src="groceries.js" type="text/javascript"></script>

  </body>
</html>
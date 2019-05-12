<?php

require "payments-process.php";

//initialize variables
$task_payment ="";
$count_todo_payment = array();
$count_completed_payment = array();

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


if (isset($_GET['edit_payment'])) {
  $id_payment = $_GET['edit_payment'];
  $update_payment = true;
  $record_payment = mysqli_query($db, "SELECT task_payment FROM todo_payment WHERE id_payment=$id_payment");

  if (@count($record_payment) == 1 ) {
    $n = mysqli_fetch_array($record_payment);
    $task_payment = $n['task_payment'];

  }
}
if (isset($_GET['completed_payment'])) {
  $id_payment = $_GET['completed_payment'];

  $sql = mysqli_query($db,"INSERT INTO completed_payment (task_payment,username) SELECT task_payment,username FROM todo_payment WHERE id_payment=$id_payment ");
  mysqli_query($db, "DELETE FROM todo_payment WHERE id_payment=$id_payment");

  $_SESSION['message'] = "Task marked as completed!"; 
  header('location: payments.php');
}

?>

<!DOCTYPE html>
<html>
  <head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   
    <script type="text/javascript" src="reminder.js"></script>
    <!-- <script type="text/javascript" src="timeTracking.js"></script> -->
    <!--Stylesheets-->
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="hamburger-menu.css">
    <link rel="stylesheet" type="text/css" href="reminder-toggle-switch.css">
    <title>Daily-Do: Home</title>


  </head>
  <body onload="displayReminders()">
    <div class="wrapper">
    <?php include "header.php"?>
      
      <!--Page Navigation-->
      <div class="pages">
        <!--tab button input-->
        <input checked="checked" id="tab1" type="radio" name="pages">
        <input id="tab2" type="radio" name="pages">
        <input id="tab3" type="radio" name="pages">
        <input id="tab4" type="radio" name="pages">
        
        <!--tab menu -->
        <nav>
            <ul> <!--EDIT THIS PART: ADD LINKS TO PAGES -->
            <li class="tab1">
                <label class="menu-btn" for="tab1"><a href="payments.php">Payments</a></label>
            </li>
            <li class="tab2">
            <label class="menu-btn" for="tab2"><a href="groceries.php">Groceries</a></label></a>
            </li>
            <li class="tab3">
                <label class="menu-btn" for="tab3"><a href="fitness.php">Fitness</a></label>
            </li>
            <li class="tab4">
                <label class="menu-btn" for="tab4"><a href="chores.php">Chores</a></label>
            </li>
            </ul>
        </nav>
        
        <!--pages -->
        <section id="main">

            <?php if(isset($_SESSION['username'])) : ?>
            <h3 class="welcome">Welcome, <em><?php echo $_SESSION['username']; ?></em></h3>
            <?php endif ?>
  
            <!--page: PAYMENTS-->
            <div class="tab1">
              <?php if (isset($_SESSION['message'])): ?>
                <div class="msg">
                  <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                  ?>
                </div>
              <?php endif ?>
              <h2 class="payments">Payments</h2>
              <!-- display progress bar -->
              <div class="progress">
                <div id='payment_meter'><div id='payment_progress'></div></div>
                <div id="payment_percentage">0%</div> 
              </div>
              <div class="fraction">
                <span id="payment_completed">0</span>/<span id="payment_total">0</span>
              </div>
              <br>
              
              <!--add/edit task-->
              <div class="container">
                <fieldset class="add">
                  <legend>ITEM</legend>
                  <form method="post" action="payments-process.php" >
                    <table class="item">
                      <tr>
                        <td>
                          <div class="input-group">
                          <input type="hidden" name="id_payment" value="<?php echo $id_payment; ?>">
                          <input class="input-item" type="text" name="task_payment" placeholder="Enter an item..." value="<?php echo $task_payment; ?>">
                          </div>
                        </td>
                        <td>
                          <div class="input-group">
                          <?php if ($update_payment == true): ?>
                          <button class="btn" type="submit" name="update_payment" title="update"><i class="far fa-save"></i></button>
                          <?php else: ?>
                          <button class="btn" type="submit" name="save_payment" title="add"><i class="fas fa-plus"></i></button>
                          <?php endif ?>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td coldpspan="2">
                          <div class="reminder">Set reminder? <input type="checkbox" class="reminder" id="reminder_payment" name="reminder_payment" /><label for="reminder_payment"></label></div>
                        </td>
                      </tr>
                    </table>
                  </form>
                </fieldset>
              </div>

              <!--todo-->
              <div class="container">
                <fieldset class="todo">
                  <?php $results = mysqli_query($db, "SELECT * FROM todo_payment WHERE username='".$_SESSION['username']."'"); ?>
                  <legend>In Progress</legend>
                  <table>
                    <thead>
                      <tr>
                        <th>Task</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Completed?</th>
                      </tr>
                    </thead>
                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                      <tr>
                        <?php if($row['reminder_payment']==1) : ?>
                          <?php $reminder_alert[] = $row['task_payment']?>
                          <td class="red"><?php echo $row['task_payment']; ?></td>
                          <input class="reminderVal" type="checkbox" name="reminder" checked value="<?php echo $row['task_payment']; ?>">
                        <?php else : ?>
                          <td><?php echo $row['task_payment']; ?></td>
                        <?php endif; ?>
                        <td>
                          <a href="payments.php?edit_payment=<?php echo $row['id_payment']; ?>" class="edit">
                            <i class="fas fa-edit"></i>
                          </a>
                        </td>
                        <td>
                          <a href="payments-process.php?del-todo_payment=<?php echo $row['id_payment']; ?>" class="delete">
                            <i class="far fa-trash-alt"></i>
                          </a>
                        </td>
                        <td>
                          <a href="payments.php?completed_payment=<?php echo $row['id_payment']; ?>" class="check">
                            <i class="fas fa-check"></i>
                          </a>
                        </td>
                      </tr>
                      <?php array_push($count_todo_payment," ") ?>
                    <?php } ?>
                    <?php $count = count($count_todo_payment) ?>
                    <input id="count_todo_payment" type="hidden" value="<?php echo $count ?>">
                  </table>
                </fieldset>	
              </div>

              <!-- completed -->
              <div class="container">
                <fieldset class="completed">
                  <?php $results = mysqli_query($db, "SELECT * FROM completed_payment WHERE username='".$_SESSION['username']."'"); ?>
                  <legend>Completed</legend>
                  <table>
                    <thead>
                      <tr>
                        <th>Task</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                      <tr>
                        <td><?php echo $row['task_payment']; ?></td>
                        <td>
                        <a href="payments-process.php?del-completed_payment=<?php echo $row['id_payment']; ?>" class="delete">
                          <i class="far fa-trash-alt"></i>
                        </a>
                        </td>
                      </tr>
                      <?php array_push($count_completed_payment," ") ?>
                    <?php } ?>
                    <?php $count = count($count_completed_payment) ?>
                    <input id="count_completed_payment" type="hidden" value="<?php echo $count ?>">
                  </table>
                </fieldset>
              </div>

              <!--timer-->
              <div class="container">
                <fieldset class="timer">
                <legend>Timer</legend>
                  <button id="start_payment">Start Timer</button>
                  <button id="end_payment">End Timer</button>
                  <div id="well_payment">0 second(s)</div>
                  </fieldset>
              </div>
            </div> <!--end of PAYMENTS-->
          </section>
        </div> <!--end of page-->
        <?php include "footer.php" ?>
    </div><!--end of wrapper -->
    <script src="payments.js" type="text/javascript"></script>
    <script src="payment-timer.js" type="text/javascript"></script>

  
  </body>
</html>
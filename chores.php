<?php

require "chores-process.php";

//initialize variables
$task_chore ="";
$count_todo_chore = array();
$count_completed_chore = array();

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


if (isset($_GET['edit_chore'])) {
  $id_chore = $_GET['edit_chore'];
  $update_chore = true;
  $record_chore = mysqli_query($db, "SELECT task_chore FROM todo_chore WHERE id_chore=$id_chore");

  if (@count($record_chore) == 1 ) {
    $n = mysqli_fetch_array($record_chore);
    $task_chore = $n['task_chore'];

  }
}
if (isset($_GET['completed_chore'])) {
  $id_chore = $_GET['completed_chore'];

  $sql = mysqli_query($db,"INSERT INTO completed_chore (task_chore,username) SELECT task_chore,username FROM todo_chore WHERE id_chore=$id_chore ");
  mysqli_query($db, "DELETE FROM todo_chore WHERE id_chore=$id_chore");

  $_SESSION['message'] = "Task marked as completed!"; 
  header('location: chores.php');
}

?>

<!DOCTYPE html>
<html>
  <head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!--Gotham Rounded Font -->
    <link rel="stylesheet" href="https://cloud.typography.com/7110534/6242772/css/fonts.css" data-noprefix />
    <script type="text/javascript" src="reminder.js"></script>
    <!--Stylesheets-->
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="hamburger-menu.css">
    <link rel="stylesheet" type="text/css" href="reminder-toggle-switch.css">
    <title>Daily-Do: Home</title>

  </head>
  <body onload="displayReminders()">
    <div class="wrapper">
      <!-- Header -->
      <?php include "header.php"?>
      
      <!--Page Navigation-->
      <div class="pages">
        <!--tab button input-->
        <input id="tab1" type="radio" name="pages">
        <input id="tab2" type="radio" name="pages">
        <input id="tab3" type="radio" name="pages">
        <input id="tab4" type="radio" name="pages" checked="checked">
        
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
  
            <!--page: chores-->
            <div class="tab4">
              <?php if (isset($_SESSION['message'])): ?>
                <div class="msg">
                  <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                  ?>
                </div>
              <?php endif ?>
              <h2 class="chores">Chores</h2>
              <!-- display progress bar -->
              <div class="progress">
                <div id='chore_meter'><div id='chore_progress'></div></div>
                <div id="chore_percentage">0%</div> 
              </div>
              <div class="fraction">
                <span id="chore_completed">0</span>/<span id="chore_total">0</span>
              </div>
              <br>

              <!--add/edit task-->
              <div class="container">
                <fieldset class="add">
                  <legend>ITEM</legend>
                  <form method="post" action="chores-process.php" >
                    <table class="item">
                      <tr>
                        <td>
                          <div class="input-group">
                          <input type="hidden" name="id_chore" value="<?php echo $id_chore; ?>">
                          <input class="input-item" type="text" name="task_chore" placeholder="Enter an item..." value="<?php echo $task_chore; ?>">
                          </div>
                        </td>
                        <td>
                          <div class="input-group">
                          <?php if ($update_chore == true): ?>
                          <button class="btn" type="submit" name="update_chore" title="update"><i class="far fa-save"></i></button>
                          <?php else: ?>
                          <button class="btn" type="submit" name="save_chore" title="add"><i class="fas fa-plus"></i></button>
                          <?php endif ?>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td coldpspan="2">
                          <div class="reminder">Set reminder? <input type="checkbox" class="reminder" id="reminder_chore" name="reminder_chore" /><label for="reminder_chore"></label></div>
                        </td>
                      </tr>
                    </table>
                  </form>
                </fieldset>
              </div>

              <!--todo-->
              <div class="container">
                <fieldset class="todo">
                  <?php $results = mysqli_query($db, "SELECT * FROM todo_chore WHERE username='".$_SESSION['username']."'"); ?>
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
                        <?php if($row['reminder_chore']==1) : ?>
                          <?php $reminder_alert[] = $row['task_chore']?>
                          <td class="red"><?php echo $row['task_chore']; ?></td>
                          <input class="reminderVal" type="checkbox" name="reminder" checked value="<?php echo $row['task_chore']; ?>">
                        <?php else : ?>
                          <td><?php echo $row['task_chore']; ?></td>
                        <?php endif; ?>
                        <td>
                          <a href="chores.php?edit_chore=<?php echo $row['id_chore']; ?>" class="edit">
                            <i class="fas fa-edit"></i>
                          </a>
                        </td>
                        <td>
                          <a href="chores-process.php?del-todo_chore=<?php echo $row['id_chore']; ?>" class="delete">
                            <i class="far fa-trash-alt"></i>
                          </a>
                        </td>
                        <td>
                          <a href="chores.php?completed_chore=<?php echo $row['id_chore']; ?>" class="check">
                            <i class="fas fa-check"></i>
                          </a>
                        </td>
                      </tr>
                      <?php array_push($count_todo_chore," ") ?>
                    <?php } ?>
                    <?php $count = count($count_todo_chore) ?>
                    <input id="count_todo_chore" type="hidden" value="<?php echo $count ?>">
                  </table>
                </fieldset>	
              </div>

              <!-- completed -->
              <div class="container">
                <fieldset class="completed">
                  <?php $results = mysqli_query($db, "SELECT * FROM completed_chore WHERE username='".$_SESSION['username']."'"); ?>
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
                        <td><?php echo $row['task_chore']; ?></td>
                        <td>
                        <a href="chores-process.php?del-completed_chore=<?php echo $row['id_chore']; ?>" class="delete">
                          <i class="far fa-trash-alt"></i>
                        </a>
                        </td>
                      </tr>
                      <?php array_push($count_completed_chore," ") ?>
                    <?php } ?>
                    <?php $count = count($count_completed_chore) ?>
                    <input id="count_completed_chore" type="hidden" value="<?php echo $count ?>">
                  </table>
                </fieldset>
              </div>

              <div class="container">
                <fieldset class="timer">
                <legend>Timer</legend>
                  <button id="start_chore">Start Timer</button>
                  <button id="end_chore">End Timer</button>
                  <div id="well_chore">0 second(s)</div>
                  </fieldset>
              </div>

            </div> <!--end of chores-->

          </section>
          
        </div> <!--end of page-->
        <?php include "footer.php" ?>
    </div><!--end of wrapper -->
    <script src="chores.js" type="text/javascript"></script>
    <script src="chore-timer.js" type="text/javascript"></script>

  </body>
</html>
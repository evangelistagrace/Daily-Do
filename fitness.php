<?php

require "fitness-process.php";

//initialize variables
$task_fitness ="";
$count_todo_fitness = array();
$count_completed_fitness = array();

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


if (isset($_GET['edit_fitness'])) {
  $id_fitness = $_GET['edit_fitness'];
  $update_fitness = true;
  $record_fitness = mysqli_query($db, "SELECT task_fitness FROM todo_fitness WHERE id_fitness=$id_fitness");

  if (@count($record_fitness) == 1 ) {
    $n = mysqli_fetch_array($record_fitness);
    $task_fitness = $n['task_fitness'];

  }
}
if (isset($_GET['completed_fitness'])) {
  $id_fitness = $_GET['completed_fitness'];

  $sql = mysqli_query($db,"INSERT INTO completed_fitness (task_fitness,username) SELECT task_fitness,username FROM todo_fitness WHERE id_fitness=$id_fitness ");
  mysqli_query($db, "DELETE FROM todo_fitness WHERE id_fitness=$id_fitness");

  $_SESSION['message'] = "Task marked as completed!"; 
  header('location: fitness.php');
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
        <input id="tab3" type="radio" name="pages" checked="checked">
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
  
            <!--page: fitness-->
            <div class="tab3">
              <?php if (isset($_SESSION['message'])): ?>
                <div class="msg">
                  <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                  ?>
                </div>
              <?php endif ?>
              <h2 class="fitness">Fitness</h2>
              <!-- display progress bar -->
              <div class="progress">
                <div id='fitness_meter'><div id='fitness_progress'></div></div>
                <div id="fitness_percentage">0%</div> 
              </div>
              <div class="fraction">
                <span id="fitness_completed">0</span>/<span id="fitness_total">0</span>
              </div>
              <br>

              <!--add/edit task-->
              <div class="container">
                <fieldset class="add">
                  <legend>ITEM</legend>
                  <form method="post" action="fitness-process.php" >
                    <table class="item">
                      <tr>
                        <td>
                          <div class="input-group">
                          <input type="hidden" name="id_fitness" value="<?php echo $id_fitness; ?>">
                          <input class="input-item" type="text" name="task_fitness" placeholder="Enter an item..." value="<?php echo $task_fitness; ?>">
                          </div>
                        </td>
                        <td>
                          <div class="input-group">
                          <?php if ($update_fitness == true): ?>
                          <button class="btn" type="submit" name="update_fitness" title="update"><i class="far fa-save"></i></button>
                          <?php else: ?>
                          <button class="btn" type="submit" name="save_fitness" title="add"><i class="fas fa-plus"></i></button>
                          <?php endif ?>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td coldpspan="2">
                          <div class="reminder">Set reminder? <input type="checkbox" class="reminder" id="reminder_fitness" name="reminder_fitness" /><label for="reminder_fitness"></label></div>
                        </td>
                      </tr>
                    </table>
                  </form>
                </fieldset>
              </div>

              <!--todo-->
              <div class="container">
                <fieldset class="todo">
                  <?php $results = mysqli_query($db, "SELECT * FROM todo_fitness WHERE username='".$_SESSION['username']."'"); ?>
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
                        <?php if($row['reminder_fitness']==1) : ?>
                          <?php $reminder_alert[] = $row['task_fitness']?>
                          <td class="red"><?php echo $row['task_fitness']; ?></td>
                          <input class="reminderVal" type="checkbox" name="reminder" checked value="<?php echo $row['task_fitness']; ?>">
                        <?php else : ?>
                          <td><?php echo $row['task_fitness']; ?></td>
                        <?php endif; ?>
                        <td>
                          <a href="fitness.php?edit_fitness=<?php echo $row['id_fitness']; ?>" class="edit">
                            <i class="fas fa-edit"></i>
                          </a>
                        </td>
                        <td>
                          <a href="fitness-process.php?del-todo_fitness=<?php echo $row['id_fitness']; ?>" class="delete">
                            <i class="far fa-trash-alt"></i>
                          </a>
                        </td>
                        <td>
                          <a href="fitness.php?completed_fitness=<?php echo $row['id_fitness']; ?>" class="check">
                            <i class="fas fa-check"></i>
                          </a>
                        </td>
                      </tr>
                      <?php array_push($count_todo_fitness," ") ?>
                    <?php } ?>
                    <?php $count = count($count_todo_fitness) ?>
                    <input id="count_todo_fitness" type="hidden" value="<?php echo $count ?>">
                  </table>
                </fieldset>	
              </div>

              <!-- completed -->
              <div class="container">
                <fieldset class="completed">
                  <?php $results = mysqli_query($db, "SELECT * FROM completed_fitness WHERE username='".$_SESSION['username']."'"); ?>
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
                        <td><?php echo $row['task_fitness']; ?></td>
                        <td>
                        <a href="fitness-process.php?del-completed_fitness=<?php echo $row['id_fitness']; ?>" class="delete">
                          <i class="far fa-trash-alt"></i>
                        </a>
                        </td>
                      </tr>
                      <?php array_push($count_completed_fitness," ") ?>
                    <?php } ?>
                    <?php $count = count($count_completed_fitness) ?>
                    <input id="count_completed_fitness" type="hidden" value="<?php echo $count ?>">
                  </table>
                </fieldset>
              </div>

              <div class="container">
                <fieldset class="timer">
                <legend>Timer</legend>
                  <button id="start_fitness">Start Timer</button>
                  <button id="end_fitness">End Timer</button>
                  <div id="well_fitness">0 second(s)</div>
                  </fieldset>
              </div>

            </div> <!--end of fitness-->
          </section>
          
        </div> <!--end of page-->
        <?php include "footer.php" ?>
    </div><!--end of wrapper -->
    <script src="fitness.js" type="text/javascript"></script>
    <script src="fitness-timer.js" type="text/javascript"></script>

  </body>
</html>
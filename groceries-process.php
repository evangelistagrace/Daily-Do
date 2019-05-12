<?php

require "db_tables.php";

//initialize variables
$id_grocery = 0;
$update_grocery = false;
$reminder_grocery = 0;

///TASK:grocery////
    //insert/save tasks into database
	if (isset($_POST['save_grocery'])) {
        if(!empty($_POST['reminder_grocery'])){
            $reminder_grocery = 1;
        }
		$task_grocery = $_POST['task_grocery'];
		mysqli_query($db, "INSERT INTO todo_grocery (task_grocery, username, reminder_grocery) VALUES ('$task_grocery', '".$_SESSION['username']."', '$reminder_grocery')"); 
		$_SESSION['message'] = "Task added!"; 
		header('location: groceries.php');
	}

	//update tasks in database
	if (isset($_POST['update_grocery'])) {
		$id_grocery = $_POST['id_grocery'];
        $task_grocery = $_POST['task_grocery'];
        if(!empty($_POST['reminder_grocery'])){
            $reminder_grocery = 1;
        }

		mysqli_query($db, "UPDATE todo_grocery SET task_grocery='$task_grocery', reminder_grocery='$reminder_grocery' WHERE id_grocery=$id_grocery");
		$_SESSION['message'] = "Task updated!"; 
		header('location: groceries.php');
	}

	//delete tasks from `todo` table
	if (isset($_GET['del-todo_grocery'])) {
		$id_grocery = $_GET['del-todo_grocery'];

		mysqli_query($db, "DELETE FROM todo_grocery WHERE id_grocery=$id_grocery");
		$_SESSION['message'] = "Task deleted!"; 
		header('location: groceries.php');
	}

	//delete tasks from `completed` table
	if (isset($_GET['del-completed_grocery'])) {
		$id_grocery = $_GET['del-completed_grocery'];

		mysqli_query($db, "DELETE FROM completed_grocery WHERE id_grocery=$id_grocery");
		$_SESSION['message'] = "Task deleted!"; 
		header('location: groceries.php');
    }
    


?>
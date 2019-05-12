<?php

require "db_tables.php";

//initialize variables
$id_chore = 0;
$update_chore = false;
$reminder_chore = 0;

///TASK:chore////
    //insert/save tasks into database
	if (isset($_POST['save_chore'])) {
        if(!empty($_POST['reminder_chore'])){
            $reminder_chore = 1;
        }
		$task_chore = $_POST['task_chore'];
		mysqli_query($db, "INSERT INTO todo_chore (task_chore, username, reminder_chore) VALUES ('$task_chore', '".$_SESSION['username']."', '$reminder_chore')"); 
		$_SESSION['message'] = "Task added!"; 
		header('location: chores.php');
	}

	//update tasks in database
	if (isset($_POST['update_chore'])) {
		$id_chore = $_POST['id_chore'];
        $task_chore = $_POST['task_chore'];
        if(!empty($_POST['reminder_chore'])){
            $reminder_chore = 1;
        }

		mysqli_query($db, "UPDATE todo_chore SET task_chore='$task_chore', reminder_chore='$reminder_chore' WHERE id_chore=$id_chore");
		$_SESSION['message'] = "Task updated!"; 
		header('location: chores.php');
	}

	//delete tasks from `todo` table
	if (isset($_GET['del-todo_chore'])) {
		$id_chore = $_GET['del-todo_chore'];

		mysqli_query($db, "DELETE FROM todo_chore WHERE id_chore=$id_chore");
		$_SESSION['message'] = "Task deleted!"; 
		header('location: chores.php');
	}

	//delete tasks from `completed` table
	if (isset($_GET['del-completed_chore'])) {
		$id_chore = $_GET['del-completed_chore'];

		mysqli_query($db, "DELETE FROM completed_chore WHERE id_chore=$id_chore");
		$_SESSION['message'] = "Task deleted!"; 
		header('location: chores.php');
    }
    


?>
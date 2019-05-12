<?php

require "db_tables.php";

//initialize variables
$id_fitness = 0;
$update_fitness = false;
$reminder_fitness = 0;

///TASK:fitness////
    //insert/save tasks into database
	if (isset($_POST['save_fitness'])) {
        if(!empty($_POST['reminder_fitness'])){
            $reminder_fitness = 1;
        }
		$task_fitness = $_POST['task_fitness'];
		mysqli_query($db, "INSERT INTO todo_fitness (task_fitness, username, reminder_fitness) VALUES ('$task_fitness', '".$_SESSION['username']."', '$reminder_fitness')"); 
		$_SESSION['message'] = "Task added!"; 
		header('location: fitness.php');
	}

	//update tasks in database
	if (isset($_POST['update_fitness'])) {
		$id_fitness = $_POST['id_fitness'];
        $task_fitness = $_POST['task_fitness'];
        if(!empty($_POST['reminder_fitness'])){
            $reminder_fitness = 1;
        }

		mysqli_query($db, "UPDATE todo_fitness SET task_fitness='$task_fitness', reminder_fitness='$reminder_fitness' WHERE id_fitness=$id_fitness");
		$_SESSION['message'] = "Task updated!"; 
		header('location: fitness.php');
	}

	//delete tasks from `todo` table
	if (isset($_GET['del-todo_fitness'])) {
		$id_fitness = $_GET['del-todo_fitness'];

		mysqli_query($db, "DELETE FROM todo_fitness WHERE id_fitness=$id_fitness");
		$_SESSION['message'] = "Task deleted!"; 
		header('location: fitness.php');
	}

	//delete tasks from `completed` table
	if (isset($_GET['del-completed_fitness'])) {
		$id_fitness = $_GET['del-completed_fitness'];

		mysqli_query($db, "DELETE FROM completed_fitness WHERE id_fitness=$id_fitness");
		$_SESSION['message'] = "Task deleted!"; 
		header('location: fitness.php');
    }
    


?>
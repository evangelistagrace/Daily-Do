<?php

require "db_tables.php";

//initialize variables
$id_payment = 0;
$update_payment = false;
$reminder_payment = 0;

///TASK:PAYMENT////
    //insert/save tasks into database
	if (isset($_POST['save_payment'])) {
        if(!empty($_POST['reminder_payment'])){
            $reminder_payment = 1;
        }
		$task_payment = $_POST['task_payment'];
		mysqli_query($db, "INSERT INTO todo_payment (task_payment, username, reminder_payment) VALUES ('$task_payment', '".$_SESSION['username']."', '$reminder_payment')"); 
		$_SESSION['message'] = "Task added!"; 
		header('location: payments.php');
	}

	//update tasks in database
	if (isset($_POST['update_payment'])) {
		$id_payment = $_POST['id_payment'];
        $task_payment = $_POST['task_payment'];
        if(!empty($_POST['reminder_payment'])){
            $reminder_payment = 1;
        }

		mysqli_query($db, "UPDATE todo_payment SET task_payment='$task_payment', reminder_payment='$reminder_payment' WHERE id_payment=$id_payment");
		$_SESSION['message'] = "Task updated!"; 
		header('location: payments.php');
	}

	//delete tasks from `todo` table
	if (isset($_GET['del-todo_payment'])) {
		$id_payment = $_GET['del-todo_payment'];

		mysqli_query($db, "DELETE FROM todo_payment WHERE id_payment=$id_payment");
		$_SESSION['message'] = "Task deleted!"; 
		header('location: payments.php');
	}

	//delete tasks from `completed` table
	if (isset($_GET['del-completed_payment'])) {
		$id_payment = $_GET['del-completed_payment'];

		mysqli_query($db, "DELETE FROM completed_payment WHERE id_payment=$id_payment");
		$_SESSION['message'] = "Task deleted!"; 
		header('location: payments.php');
    }
    


?>
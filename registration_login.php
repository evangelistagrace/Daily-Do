<?php

require "db_tables.php";

//initialize variables
$username = "";
$email = "";
$childUsername = "";
$errors = array();
////REGISTER////

    if(isset($_POST['register'])){
        //verify input
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $email = mysqli_real_escape_string($db,$_POST['email']);
        $userType = mysqli_real_escape_string($db,$_POST['userType']);
        $password_1 = mysqli_real_escape_string($db,$_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db,$_POST['password_2']);
        $childUsername = mysqli_real_escape_string($db,$_POST['childUsername']);
    
        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($email)){
            array_push($errors, "Email is required");
        }
        if(empty($password_1)){
            array_push($errors, "Password is required");
        }
        if($password_1!=$password_2){
            array_push($errors, "Passwords do not match");
        }

        //check if there's existing user in the database
        $user_check_query = "SELECT * FROM user WHERE username ='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if($user){
            if($user['username'] === $username){
                array_push($errors, "Username already taken");
            }
            if($user['email'] === $email){
                array_push($errors, "Email already taken");
            }
        }

        //Register user into database if there's no error
        if(count($errors)==0){
            $password  = md5($password_1); //encrypt password

            //insert data into user table
            $query = "INSERT INTO user (username, email, userType, password) VALUES ('$username', '$email', '$userType', '$password')";
            mysqli_query($db, $query);

            // if user is student, enter data into student table
            if($userType == "Student"){
                $query = "INSERT INTO student (username, email, userType, password) VALUES ('$username', '$email', '$userType', '$password')";
                mysqli_query($db, $query);
                $_SESSION['userId'] = $userId;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['userType'] = $userType;
                
                header('location: payments.php');
            }
            if($userType == "Parent"){
                $query = "INSERT INTO parent (username, email, userType, password, childUsername) VALUES ('$username', '$email', '$userType', '$password','$childUsername')";
                mysqli_query($db, $query);
                $_SESSION['userId'] = $userId;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['userType'] = $userType;
                
                header('location: payments-view.php');
            }
        }
    }

    ////LOGIN////
    if(isset($_POST['login'])){
        //verify input
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(empty($username)){
            array_push($errors, "Username is required");
        }
        if(empty($password)){
            array_push($errors, "Password is required");
        }

        if(count($errors) == 0){
            $password = md5($password);
            $user_check_query = "SELECT * FROM user WHERE username ='$username' OR email='$email' LIMIT 1";
            $result = mysqli_query($db, $user_check_query);
            $user = mysqli_fetch_assoc($result);

            if(mysqli_num_rows($result) == 1){ //check if there exists this user in the database already
                $_SESSION['username'] = $user['username'];
                $_SESSION['userId'] = $user['userId'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['userType'] = $user['userType'];

                if($_SESSION['userType'] == "Student"){
                    header('location: payments.php');
                }
                else if($_SESSION['userType'] == "Parent"){
                    header('location: payments-view.php');
                }
                
            }
            else{
                array_push($errors, "Wrong username/password");
            }
        }
    }


?>
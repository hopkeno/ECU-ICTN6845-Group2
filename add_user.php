<?php
    require_once("database.php");
    require_once("user_db.php");
    
    // Get the user data from the form
    $username = filter_input(INPUT_POST, "username");
    $password = filter_input(INPUT_POST, "password");
    $password2 = filter_input(INPUT_POST, "password2");
    $email = filter_input(INPUT_POST, "email");
    $firstname = filter_input(INPUT_POST, "first_name");
    $lastname = filter_input(INPUT_POST, "last_name");

    if ($username == null or $password == null) {
        //Verify there is actually a user/pass to add
        $err_msg = "You must enter a username and password. Please try again.";
        include("error.php");
    } elseif ($password != $password2) {
        $err_msg = "Passwords must match. Please try again.";
        include("error.php");        
    } else {
        //Add the see if user already exists to the DB        
        if (user_exists($username)) {
            $err_msg = "Username invalid, please try again.";
            include("error.php");
        } else if (email_exists($email)) {
            $err_msg = "It appears you are already registered. Please try logging in.";
            include("error.php");
        } else {
            add_user($username,$password,$email,$firstname,$lastname);
            //Display the index
            header("Location: .");
        }
    }
?>


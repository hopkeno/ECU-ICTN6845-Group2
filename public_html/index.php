<?php
// Start session management and include DB functions
session_start();
require_once('database.php');
require_once('user_db.php');

// Determine action
$action = filter_input(INPUT_POST,'action');
if ($action == NULL) {
    $action =  filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'show_tasks';
    }
}

// If the user isn't logged in, force the login
if (!isset($_SESSION['is_authenticated'])) {
    $action = 'login';
}

// Perform the specified action
switch($action) {
    case 'login':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        if (is_valid_login($username,$password)) {
            // if the user is authenticated, take them to the task page
            $_SESSION['is_authenticated'] = true;
            set_session($username);
            if($_SESSION['is_admin']) {
                include("task_admin.php");
            } else {
                include("task.php");
            }
        } else if ($username != null or $password != null){
            // if the user isn't authenticated we send them back to the login page
            include("login.php");
        } else {
            include("home.php");
        }
        break;
    case 'show_tasks':
        if ($_SESSION['is_admin']) {
            include("task_admin.php");
        } else {
            include("task.php");
        }
        break;
    case 'logout':
        $_SESSION = array();
        session_destroy();
        $login_message = 'You have been logged out.';
        include("index.php");
        break;
}
?>

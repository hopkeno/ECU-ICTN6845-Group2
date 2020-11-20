<?php
// Start session management and include DB functions
session_start();
require_once('database.php');
require_once('user_db.php');
require_once('task_db.php');

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
    case 'remove_task':
        if ($_SESSION['is_admin']) {
            $tid = filter_input(INPUT_GET, 'taskid');
            remove_task($tid);
            header("Location: index.php");
        } else {
            include("task.php");
        }
        break;
    case 'edit_task':
        if ($_SESSION['is_admin']) {
            include("edit_task.php");
        } else {
            include("task.php");
        }
        break;
    case 'user_admin':
        if ($_SESSION['is_admin']) {
            include("user_admin.php");
        } else {
            include("task.php");
        }
        break;
    case 'delete_user':
        if ($_SESSION['is_admin']) {
            $uid = filter_input(INPUT_GET, 'volunteer_id');
            delete_user($uid);
            header("Location: index.php?action=user_admin");
        } else {
            include("task.php");
        }
        break;
    case 'update_user':
        if ($_SESSION['is_admin']) {
            $user = array();
            $user['volunteerID'] = filter_input(INPUT_POST, 'volunteer_id');
            $user['first_name'] = filter_input(INPUT_POST, 'firstname');
            $user['last_name'] = filter_input(INPUT_POST, 'lasstname');
            $user['email'] = filter_input(INPUT_POST, 'email');
            $user['is_admin'] = filter_input(INPUT_POST, 'isadmin');          
            update_user($user);
            header("Location: index.php?action=user_admin");
        } else {
            include("task.php");
        }
        break;     
    case 'update_task':
        if ($_SESSION['is_admin']) {
            $task = array();
            $task["taskID"] = filter_input(INPUT_POST, 'task_id');
            $task["title"] = filter_input(INPUT_POST, 'task_title');
            $task["personsNeeded"] = filter_input(INPUT_POST, 'task_personsNeeded');
            $task["scheduledTime"] = filter_input(INPUT_POST, 'task_scheduledTime');
            $task["location"] = filter_input(INPUT_POST, 'task_location');
            update_task($task);
            header("Location: index.php");
        } else {
            include("task.php");
        }
        break;    
    case 'create_task':
        if ($_SESSION['is_admin']) {
            $task = array();
            $task["title"] = filter_input(INPUT_POST, 'task_title');
            $task["personsNeeded"] = filter_input(INPUT_POST, 'task_personsNeeded');
            $task["scheduledTime"] = filter_input(INPUT_POST, 'task_scheduledTime');
            $task["location"] = filter_input(INPUT_POST, 'task_location');
            add_task($task);
            header("Location: index.php");
        } else {
            include("task.php");
        }
        break;
    case 'cancel_signup':
        $taskid = filter_input(INPUT_POST, 'cancel_taskid');
        unassign_task($taskid);
        include("task.php");
        break;
    case 'assign_volunteer':
        if ($_SESSION['is_admin']) {
            $assignments = filter_input(INPUT_POST, 'assign_volunteer', FILTER_DEFAULT , FILTER_REQUIRE_ARRAY);
            foreach ($assignments as $task) {
                $tdata = explode(",",$task);
                $tid = $tdata[0];
                $vid = $tdata[1];
                $taskinfo = get_task($tid);
                $assigned = is_assigned($tid);  //see if the task is assigned
                if ($vid == "-" && $assigned) {
                    //if the volunteer ID is blank and the task was previously assigned, unassign it 
                    unassign_task($tid);
                } else if ($assigned && $vid != $taskinfo['volunteerID']) {
                    //if the task was previously assigned to a different volunteer, reassign it
                    assign_task($tid,$vid,$_SESSION['volunteerID']);
                } else if (!$assigned) {
                    //otherwise, if it is unassigned, assign it as directed
                    assign_task($tid,$vid,$_SESSION['volunteerID']);
                }
            }
            include("task_admin.php");
        } else {
            $taskid = filter_input(INPUT_POST, 'signup_taskid');
            assign_task($taskid,$_SESSION["volunteerID"],$_SESSION["volunteerID"]);
            include("task.php");
        }
        break;
    case 'logout':
        $_SESSION = array();
        session_destroy();
        $login_message = 'You have been logged out.';
        include("index.php");
        break;
    default:
        include("index.php");
        break;
}
?>

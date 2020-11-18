<?php

function get_unassigned() {
    global $db;
    $query = 'SELECT * FROM tasks WHERE volunteerID is NULL';
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

function is_assigned($taskID) {
    $task = get_task($taskID);
    if ($task["volunteerID"]) {
        return true;
    } else {
        return false;
    }
}

function get_tasks($volunteerId = null) {
    global $db;
    if ($volunteerId) {
        $query = 'SELECT * FROM tasks WHERE volunteerID = :volId';
        $statement = $db->prepare($query);
        $statement->bindValue(':volId', $volunteerId);
    } else {
        $query = 'SELECT * FROM tasks';
        $statement = $db->prepare($query);
    }
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

function get_task($taskID) {
    global $db;
    $query = 'SELECT * FROM tasks WHERE taskID = :taskId';
    $statement = $db->prepare($query);
    $statement->bindValue(':taskId', $taskID);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result;
}

function add_task($task) {
    //adds a task to the db
    global $db;
    $query = 'INSERT INTO tasks (title,personsNeeded,scheduledTime,location) VALUES (:title,:persons,:sched,:loc);';
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $task["title"]);    
    $statement->bindValue(':persons', $task["personsNeeded"]);    
    $statement->bindValue(':sched', $task["scheduledTime"]);
    $statement->bindValue(':loc', $task["location"]);
    $statement->execute();
    $statement->closeCursor();
}

function update_task($task) {
    //updates a task in the db
    global $db;
    $query = 'UPDATE tasks SET title = :title, personsNeeded = :persons, scheduledTime = :sched, location = :loc WHERE taskID = :taskid;';
    $statement = $db->prepare($query);
    $statement->bindValue(':taskid', $task["taskID"]);
    $statement->bindValue(':title', $task["title"]);    
    $statement->bindValue(':persons', $task["personsNeeded"]);    
    $statement->bindValue(':sched', $task["scheduledTime"]);
    $statement->bindValue(':loc', $task["location"]);
    $statement->execute();
    $statement->closeCursor();
}


function assign_task($taskId,$volunteerId,$assignerId) {
    //assigns a task to a user, and records who made the assignment
    global $db;
    $query = 'UPDATE tasks SET volunteerID = :volId, assignerID = :assignId WHERE taskID = :taskId;';
    $statement = $db->prepare($query);
    $statement->bindValue(':volId', $volunteerId);    
    $statement->bindValue(':assignId', $assignerId);    
    $statement->bindValue(':taskId', $taskId);    
    $statement->execute();
    $statement->closeCursor();
}

function unassign_task($taskId) {
    //unassigns a task so it is no longer assigned to a volunteer
    global $db;
    $query = 'UPDATE tasks SET volunteerID = null, assignerID = null WHERE taskID = :taskId;';
    $statement = $db->prepare($query);
    $statement->bindValue(':taskId', $taskId);    
    $statement->execute();
    $statement->closeCursor();
}

function remove_task($taskId) {
    //deletes a task from the database
    global $db;
    $query = 'DELETE FROM tasks WHERE taskID = :taskId;';
    $statement = $db->prepare($query);
    $statement->bindValue(':taskId', $taskId);    
    $statement->execute();
    $statement->closeCursor();
}


?>
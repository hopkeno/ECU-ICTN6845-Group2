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

function get_tasks($volunteerId) {
    global $db;
    $query = 'SELECT * FROM tasks WHERE volunteerID = :volId';
    $statement = $db->prepare($query);
    $statement->bindValue(':volId', $volunteerId);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

?>
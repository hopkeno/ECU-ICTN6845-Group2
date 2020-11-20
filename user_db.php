<?php

function add_user($username,$password,$email,$first,$last) {
    //adds a user to the db
    global $db;
    $hash = password_hash($password,PASSWORD_DEFAULT);
    $query = 'INSERT INTO users (username, password, email, first_name, last_name) VALUES (:username, :password, :email, :firstname, :lastname);';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);    
    $statement->bindValue(':password', $hash);
    $statement->bindValue(':email', $email);    
    $statement->bindValue(':firstname', $first);
    $statement->bindValue(':lastname', $last);
    $statement->execute();
    $statement->closeCursor();
}

function delete_user($volID) {
    //removes a user from the db
    global $db;
    $query = 'DELETE FROM users WHERE volunteerID = :vid;';
    $statement = $db->prepare($query);
    $statement->bindValue(':vid', $volID);    
    $statement->execute();
    $statement->closeCursor();
}

function update_user($user) {
    //updates a user in the db
    global $db;
    $query = 'UPDATE users SET username = :user, first_name = :cn, last_name = :sn, email = :email, is_admin = :adm  WHERE volunteerID = :volid;';
    $statement = $db->prepare($query);
    $statement->bindValue(':volid', $user["volunteerID"]);
    $statement->bindValue(':user', $user["username"]);
    $statement->bindValue(':cn', $user["first_name"]);    
    $statement->bindValue(':sn', $user["last_name"]);    
    $statement->bindValue(':email', $user["email"]);
    $statement->bindValue(':adm', $user["is_admin"]);
    $statement->execute();
    $statement->closeCursor();
}

function user_exists($username) {
    //checks to see if a user exists in the db based on username
    global $db;
    $query = 'SELECT * FROM users WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    if ($results == null)
        return false;
    else
        return true;
}

function is_valid_login($username,$password) {
    //validates login info is correct
    global $db;
    $query = 'SELECT password FROM users WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();
    $hash = $row['password'];
    return password_verify($password, $hash);
}

function email_exists($email) {
    //checks to see if an email address exists in the db
    global $db;
    $query = 'SELECT * FROM users WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    if ($results == null)
        return false;
    else
        return true;
}

function set_session($username) {
    //sets session variables for the logged in user
    global $db;
    $query = 'SELECT * FROM users where username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();
    $_SESSION['volunteerID'] = $row['volunteerID'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['first_name'] = $row['first_name'];
    $_SESSION['last_name'] = $row['last_name'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['is_admin'] = $row['is_admin'];
}

function get_volunteer($id) {
    //returns a details of a specific volunteer from the database based on id
    global $db;
    $query = 'SELECT volunteerID, username, first_name, last_name, email, is_admin FROM users where volunteerID = :volID';
    $statement = $db->prepare($query);
    $statement->bindValue(':volID', $id);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();
    return $row;
}

function get_volunteers() {
    //returns all volunteers from the database
    global $db;
    $query = 'SELECT volunteerID, username, first_name, last_name, email, is_admin FROM users';
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}


?>
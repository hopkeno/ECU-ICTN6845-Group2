<?php
    $dsn = 'mysql:host=localhost;dbname=taskdb';
    $username = 'taskdb_admin';
    $password = 'password';
    global $db;
    try {
        $db = new PDO($dsn, $username, $password); //creates PDO object
    } catch (PDOException $e) {
        $err_msg = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>

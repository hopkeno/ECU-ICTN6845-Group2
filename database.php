<?php
    $dsn = $_ENV['DB_DSN'];
    $username = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASS'];
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::MYSQL_ATTR_SSL_CA => '/path/to/cacert.pem',
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
    );
    global $db;
    try {
        $db = new PDO($dsn, $username, $password, $options); //creates PDO object
    } catch (PDOException $e) {
        $err_msg = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>

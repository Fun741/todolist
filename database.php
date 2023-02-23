<?php
    $dsn = 'mysql:host=localhost; dbname=todolist';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username);
    } catch (PDOException $e) {
        $error_message = 'Database error';
        $error_message .= $e->getMessage();
        echo $error_message;
        //include('database_error.php');
        exit();
    }
?>
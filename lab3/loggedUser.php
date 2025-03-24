<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $lines = file("users.txt");

    $login_successful = false;

    foreach ($lines as $line) {
        $line = trim($line);

        
        $fields = explode(",", $line); //array of fields

       
        if ($fields[0] === $id && $fields[2] === $email && $fields[3] === $password) {
            $login_successful = true;

            $_SESSION['login'] = true;
            $_SESSION['id'] = $fields[0]; 
            $_SESSION['name'] = $fields[1]; 
            $_SESSION['email'] = $fields[2];
            $_SESSION['room'] = $fields[4]; 

            header("Location: home.php");
            exit();
        }
        
    }


    if (!$login_successful) {
        $_SESSION['error'] = "Invalid email or password.";
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
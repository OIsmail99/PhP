<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customers</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5"></body>

<?php
require_once "helpers.php";

$lines = file("users.txt");
$table = [];

if ($lines) {
    foreach ($lines as $line) {
        $line = trim($line); 
        $fields = explode(",", $line); 

        
        $id = $fields[0] ?? '';
        $name = $fields[1] ?? '';
        $email = $fields[2] ?? '';
        $room = $fields[4] ?? ''; 

        $table[] = [$id, $name, $email, $room];
    }
}


echo '<h1 class="text-center mt-5 fw-bold text-primary">🎉 Users List ! 🎉</h1>';
echo '<a href="register.php" class="btn btn-primary">Add New Customer</a>';
echo '<a href="login.php" class="btn btn-primary">Login</a>';

$headers = ["ID", "Name", "Email", "Room No."];
drawTable($headers, $table);
?>



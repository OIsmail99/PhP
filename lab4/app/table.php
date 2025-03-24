<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5"></body>

<?php
require_once "../helpers.php";
require_once "../DB/db_operations.php";

$data = selectData();

echo '<h1 class="text-center mt-5 fw-bold text-primary">🎉 Users List ! 🎉</h1>';
echo '<a href="register.php" class="btn btn-primary">Add New Customer</a>';

$headers = ["ID", "Name", "Email", "Room No."];
drawTable2($headers, $data);
?>



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

    $lines = file("customer.txt");
    $table  =[];
//    var_dump($lines);
    if ($lines) {
        #prepare data
        foreach ($lines as $line) {
            $line = trim($line);  # remove extra spaces and \n
            # split line to fields
            $line = explode(":", $line);
            
            array_splice($line, 5, 2);
            array_splice($line, 3, 1);
            $table[] = $line;  # append line in the array 
        }
    }


//    echo "<pre>";
//    print_r($table);
//    echo "</pre>";
    echo '<h1 class="text-center mt-5 fw-bold text-primary">🎉 Customer List ! 🎉</h1>';
    $headers = ["ID", "Full Name", "Address", "Skills", "Department","Delete"];
echo '<a href="form.php" class="btn btn-primary">Add New Customer</a>
';
    drawTable($headers, $table);

?>



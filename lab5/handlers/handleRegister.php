<?php
require_once "../helpers.php";
require_once "../DB/dbOperations.php";
$formDataIssues = validatePostData($_POST);
$formErrors = $formDataIssues["errors"];
$oldData = $formDataIssues["valid_data"];

if (count($formErrors) > 0) {
    $errors = json_encode($formErrors);
    $queryString = "errors={$errors}";
    $old_data = json_encode($oldData);
    if ($old_data) {
        $queryString .= "&old={$old_data}";
    }
    header("location:register.php?{$queryString}");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $confirm_password = $_POST['confirm_password'];
    $room = $_POST['room'];
    $image_name = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp = $_FILES['image']['tmp_name'];

    $valid_extensions = array("jpeg", "jpg", "png");
    $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

    if (!in_array($ext, $valid_extensions)) {
        $formErrors['image'] = "Please upload a valid file (JPEG, JPG, PNG).";
    }

    
    if (!preg_match('/^[a-z0-9_]{8,}$/', $password)) {
        $formErrors['password'] = "Password is weak.";
    }

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formErrors['email'] = "Invalid email address.";
    }

    
    if (count($formErrors) > 0) {
        $errors = json_encode($formErrors);
        $queryString = "errors={$errors}";
        $old_data = json_encode($oldData);
        if ($old_data) {
            $queryString .= "&old={$old_data}";
        }
        header("location:../app/register.php?{$queryString}");
        exit();
    }

    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $image_name = uniqid() . "." . $ext;
    $image_path = $upload_dir . $image_name;


    
    if ($password == $confirm_password) {
            $db = Database::getInstance();
            $insertedId = $db->insertData($name, $email, $hashedPassword, $room, $image_path);
            // $data = "{$id},{$name},{$email},{$password},{$room},{$image_path}\n";
            // $saved = appendDataTofile("users.txt", $data);

            if ($insertedId && move_uploaded_file($image_tmp, $image_path)) {
                echo '<h1 class="mt-5 fw-bold text-primary">🎉 Data Saved! 🎉</h1>';
                echo '<a class="btn btn-primary btn-lg shadow-lg rounded-pill px-4 py-2 fw-bold" href="../app/table.php">
                    🚀 Display All Messages
                  </a>';
                echo "<p>Thanks $name </p>";
                echo "<h3>Please Review Your Information</h3>";
                echo "<p><strong>ID:</strong> $insertedId</p>";
                echo "<p><strong>Name:</strong> $name</p>";
                echo "<p><strong>Email:</strong> $email</p>";
                echo "<p><strong>Your Room:</strong><br>$room</p>";
                echo "<p><strong>Image:</strong><br><img src='$image_path' alt='User Image' width='100'></p>";
                $_POST = null;
            } else {
                echo "<h1>Error Saving Data</h1>";
            }
    } else {
        echo "<h1>Password and Confirm Password do not match</h1>";
    }
} else {
    echo "<h1>Error Processing Data</h1>";
}

?>
<?php
require_once '../DB/db_operations.php';
require_once '../helpers.php';

// Check if it's a GET request to display the edit form
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get user data from mysql
    $userData = getUserById($id);
    
    // if (!$userData) {
    //     echo "User not found";
    //     exit;
    // }
    
    // Display edit form with user data
    include_once '../app/edit_form.php';
}
// Check if it's a POST request to update the user
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form data
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
        header("location:handleEdit.php?id={$_POST['id']}&{$queryString}");
        exit();
    }
    
    // Prepare update fields
    $updateFields = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'room' => $_POST['room'],
        'password' => $_POST['password']
    ];
    
    
    // if (!empty($_POST['password'])) {
    //     $updateFields['password'] = $_POST['password'];
    // }
    
    // Handle image upload if provided
    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        
        $valid_extensions = array("jpeg", "jpg", "png");
        if (in_array($ext, $valid_extensions)) {
            $upload_dir = "../handlers/uploads/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            $image_name = uniqid() . "." . $ext;
            $image_path = $upload_dir . $image_name;
            
            if (move_uploaded_file($image_tmp, $image_path)) {
                $updateFields['image_path'] = $image_path;
            }
        }
    }
    
    
    $id = $_POST['id'];
    $result = editData($id, $updateFields);
    
    if ($result) {
        header("Location: ../app/table.php");
    }
} else {
    header("Location: ../app/table.php");
}


function getUserById($id) {
    try {
        $conn = connect_to_db_pdo();
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        return false;
    } finally {
        $conn = null;
    }
}
?>
<?php

require_once "helpers.php";

$formDataIssues = validatePostData($_POST);
$formErrors = $formDataIssues["errors"];
$oldData = $formDataIssues["valid_data"];

if (count($formErrors)) {
    $errors = json_encode($formErrors);
    $queryString = "errors={$errors}";
    $old_data = json_encode($oldData);
    if ($old_data) {
        $queryString .= "&old={$old_data}";
    }
    header("location:form.php?{$queryString}");
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $address = $_POST['address'];
        $country = $_POST['country'];
        $gender = $_POST['gender'];
        $skills = "None";
        if (!empty($_POST['skills'])) {
            $skills = "";
            foreach ($_POST['skills'] as $skill) {
                $skills .= $skill . "<br>";
            }
        }
        $username = $_POST['username'];
        $password = $_POST['password'];
        $department = $_POST['department'];
        $captcha = $_POST['captcha'];
        $full_name = $first_name . ' ' . $last_name;
        if ($gender == "Male")
            $title = "Mr.";
        else
            $title = "Miss";
        $id = generateID();

        if ($captcha === "6h68Gc") {
            $info = "{$id}:{$full_name}:{$address}:{$country}:{$skills}:{$username}:{$password}:{$department}\n";

            $saved = appendDataTofile("customer.txt", $info);
            if ($saved) {
                echo '<h1 class="mt-5 fw-bold text-primary">🎉 Data Saved! 🎉</h1>';
                echo '<a class="btn btn-primary btn-lg shadow-lg rounded-pill px-4 py-2 fw-bold" href="table.php">
                    🚀 Display All Messages
                  </a>';
            echo "<p>Thanks ($title) $full_name</p>";
            echo "<h3>Please Review Your Information</h3>";
            echo "<p><strong>Name:</strong> $first_name $last_name</p>";
            echo "<p><strong>Address:</strong> $address</p>";
            echo "<p><strong>Your Skills:</strong><br>$skills</p>";
            echo "<p><strong>Department:</strong> $department</p>";
                $_POST = null;
            } else {
                echo '<h1 class="mt-5 fw-bold text-danger"> Contact your Admin </h1>';
            }
            
        } else {
            echo "<h3>Invalid Captcha</h3>";
        }
    } else {
        echo "Invalid request.";
    }
}
?>
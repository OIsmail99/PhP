<?php

function isValidInput($input){
    foreach($input as $key => $value){
        if(empty($value)){
            
        }
    }
    var_dump($input);
}

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$address = $_POST["address"];
$country = $_POST["country"];
$gender = $_POST["gender"];
$skills = $_POST["skills"];
$username = $_POST["username"];
$password = $_POST["password"];
isValidInput($_POST);
$correctCaptcha = "14QbZ";
$userCaptcha = $_POST["captcha"];

if ($userCaptcha !== $correctCaptcha) {
    header("Location: form.html?error=captcha");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h3 class="card-title text-center">Form Submission Details</h3>
                    </div>
                    <div class="card-body">
                        <p> <?php
                        if ($gender === "Male") {
                            echo "Hello MR $firstName";
                        } else {
                            echo "Hello MRS $firstName";
                        }
                        ?>

                        </p>

                        <div class="mb-3">
                            <strong>First Name:</strong> <?php echo $firstName; ?>
                        </div>
                        <div class="mb-3">
                            <strong>Last Name:</strong> <?php echo $lastName; ?>
                        </div>
                        <div class="mb-3">
                            <strong>Address:</strong> <?php echo $address; ?>
                        </div>
                        <div class="mb-3">
                            <strong>Country:</strong> <?php echo $country; ?>
                        </div>
                        <div class="mb-3">
                            <strong>Gender:</strong> <?php echo $gender; ?>
                        </div>
                        <div class="mb-3">
                            <strong>Skills:</strong> <?php
                            for ($i = 0; $i < count($skills); $i++) {
                                echo $skills[$i];
                                echo "<br>";
                            }
                            ?>
                        </div>
                        <div class="mb-3">
                            <strong>Username:</strong> <?php echo $username; ?>
                        </div>
                        <div class="mb-3">
                            <strong>Password:</strong> <?php echo $password; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
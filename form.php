<?php
$errors = [];
$old_data = [];

if (isset($_GET["errors"])) {
    $errors = json_decode($_GET["errors"], true);
}

if (isset($_GET["old"])) {
    $old_data = json_decode($_GET["old"], true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Registration</h2>
                    </div>
                    <div class="card-body">
                        <form action="done.php" method="post">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $old_data['first_name'] ?? ''; ?>">
                                <div class="text-danger"> <?php echo $errors['first_name'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo $old_data['last_name'] ?? ''; ?>">
                                <div class="text-danger"> <?php echo $errors['last_name'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control"><?php echo $old_data['address'] ?? ''; ?></textarea>
                                <div class="text-danger"> <?php echo $errors['address'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Country</label>
                                <select name="country" class="form-select">
                                    <?php $countries = ['USA', 'UK', 'India', 'Egypt', 'Mexico', 'Sudan']; ?>
                                    <?php foreach ($countries as $country): ?>
                                        <option value="<?php echo $country; ?>" <?php echo ($old_data['country'] ?? '') == $country ? 'selected' : ''; ?>><?php echo $country; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="text-danger"> <?php echo $errors['country'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Gender</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Male" <?php echo ($old_data['gender'] ?? '') == 'Male' ? 'checked' : ''; ?>>
                                    <label class="form-check-label">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Female" <?php echo ($old_data['gender'] ?? '') == 'Female' ? 'checked' : ''; ?>>
                                    <label class="form-check-label">Female</label>
                                </div>
                                <div class="text-danger"> <?php echo $errors['gender'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Skills</label><br>
                                <?php $skills = ['PHP', 'MySQL', 'J2SE', 'PostgreSQL']; ?>
                                <?php foreach ($skills as $skill): ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="skills[]" value="<?php echo $skill; ?>" <?php echo (isset($old_data['skills']) && in_array($skill, $old_data['skills'])) ? 'checked' : ''; ?>>
                                        <label class="form-check-label"> <?php echo $skill; ?> </label>
                                    </div>
                                <?php endforeach; ?>
                                <div class="text-danger"> <?php echo $errors['skills'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $old_data['username'] ?? ''; ?>">
                                <div class="text-danger"> <?php echo $errors['username'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control">
                                <div class="text-danger"> <?php echo $errors['password'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <input type="text" name="department" class="form-control" value="OpenSource" readonly>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Captcha</label>
                                <input type="text" name="captcha" class="form-control" value="<?php echo $old_data['captcha'] ?? ''; ?>">
                                <span class="text-muted">6h68Gc</span>
                                <div class="text-danger"> <?php echo $errors['captcha'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <input type="reset" class="btn btn-secondary" value="Reset">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

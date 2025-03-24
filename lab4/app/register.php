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
                        <form action="../handlers/handlerRegister.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $old_data['name'] ?? ''; ?>">
                                <div class="text-danger"> <?php echo $errors['name'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $old_data['email'] ?? ''; ?>">
                                <div class="text-danger"> <?php echo $errors['email'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" value="<?php echo $old_data['password'] ?? ''; ?>">
                                <div class="text-danger"> <?php echo $errors['password'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" value="<?php echo $old_data['confirm_password'] ?? ''; ?>">
                                <div class="text-danger"> <?php echo $errors['confirm_password'] ?? ''; ?> </div>
                            </div>
                            
                            
                            
                            <div class="mb-3">
                                <label class="form-label">Room No.</label><br>
                                <?php $rooms = ['Application1', 'Application2', 'Cloud']; ?>
                                <?php foreach ($rooms as $room): ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="room" value="<?php echo $room; ?>" 
                                               <?php echo (isset($old_data['room']) && $old_data['room'] === $room) ? 'checked' : ''; ?>>
                                        <label class="form-check-label"> <?php echo $room; ?> </label>
                                    </div>
                                <?php endforeach; ?>
                                <div class="text-danger"> <?php echo $errors['room'] ?? ''; ?> </div>
                            </div>
                
                            
                            <div class="mb-3">
                                <label class="form-label">Profile Picture</label>
                                <input type="file" name="image" class="form-control-file">
                                <div class="text-danger"> <?php echo $errors['profile'] ?? ''; ?> </div>
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
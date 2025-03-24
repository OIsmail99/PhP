<?php
$errors = [];
$old_data = [];

if (isset($_GET["errors"])) {
    $errors = json_decode($_GET["errors"], true);
}

if (isset($_GET["old"])) {
    $old_data = json_decode($_GET["old"], true);
}

// Use old data if available, otherwise use userData from the database
$data = !empty($old_data) ? $old_data : $userData;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-warning text-white text-center">
                        <h2>Edit User</h2>
                    </div>
                    <div class="card-body">
                        <form action="../handlers/handleEdit.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $userData['id']; ?>">
                            
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $data['name'] ?? ''; ?>">
                                <div class="text-danger"> <?php echo $errors['name'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $data['email'] ?? ''; ?>">
                                <div class="text-danger"> <?php echo $errors['email'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" value="<?php echo $data['password'] ?? ''; ?>">
                                <div class="text-danger"> <?php echo $errors['password'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Room No.</label><br>
                                <?php $rooms = ['Application1', 'Application2', 'Cloud']; ?>
                                <?php foreach ($rooms as $room): ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="room" value="<?php echo $room; ?>" 
                                               <?php echo (isset($data['room']) && $data['room'] === $room) ? 'checked' : ''; ?>>
                                        <label class="form-check-label"> <?php echo $room; ?> </label>
                                    </div>
                                <?php endforeach; ?>
                                <div class="text-danger"> <?php echo $errors['room'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Profile Picture (leave empty to keep current)</label>
                                <?php if (!empty($userData['image_path'])): ?>
                                    <div class="mb-2">
                                        <img src="<?php echo $userData['image_path']; ?>" alt="Current profile picture" width="100">
                                        <p class="small">Current profile picture</p>
                                    </div>
                                <?php endif; ?>
                                <input type="file" name="image" class="form-control-file">
                                <div class="text-danger"> <?php echo $errors['image'] ?? ''; ?> </div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <input type="submit" class="btn btn-warning" value="Update">
                                <a href="../app/table.php" class="btn btn-secondary">Cancel</a>
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
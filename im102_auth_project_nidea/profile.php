<?php
session_start();
require_once 'db_connect.php'; // your existing connection file
require_once 'upload.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user_id'];
$message = '';
$error = '';

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Handle profile picture upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Upload profile picture
    if (!empty($_FILES['profile_picture']['name'])) {
        $result = uploadProfilePicture($_FILES['profile_picture']);
        if (isset($result['error'])) {
            $error = $result['error'];
        } else {
            // Delete old picture
            if ($user['profile_picture']) {
                $oldFile = 'uploads/profiles/' . $user['profile_picture'];
                if (file_exists($oldFile)) unlink($oldFile);
            }
            $newFilename = $result['filename'];
            $stmtUpdate = $conn->prepare("UPDATE users SET profile_picture = ? WHERE id = ?");
            $stmtUpdate->bind_param("si", $newFilename, $userId);
            $stmtUpdate->execute();
            $user['profile_picture'] = $newFilename;
            $message = "Profile picture uploaded!";
        }
    }

    // Update bio
    if (isset($_POST['bio'])) {
        $bio = trim($_POST['bio']);
        $stmtUpdate = $conn->prepare("UPDATE users SET bio = ? WHERE id = ?");
        $stmtUpdate->bind_param("si", $bio, $userId);
        $stmtUpdate->execute();
        $user['bio'] = $bio;
        if (!$message) $message = "Profile updated!";
    }
}

// Profile picture path
$profilePic = $user['profile_picture'] && file_exists('uploads/profiles/' . $user['profile_picture'])
    ? 'uploads/profiles/' . $user['profile_picture']
    : 'https://via.placeholder.com/150?text=No+Photo';
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 50px auto; padding: 20px; }
        .card { background: white; border: 1px solid #ddd; border-radius: 10px; padding: 30px; text-align: center; }
        .profile-img { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #007bff; }
        .info p { padding: 10px; background: #f8f9fa; margin: 5px 0; border-radius: 5px; text-align: left; }
        .message { padding: 10px; background: #d4edda; color: #155724; border-radius: 5px; margin: 10px 0; }
        .error { padding: 10px; background: #f8d7da; color: #721c24; border-radius: 5px; margin: 10px 0; }
        input, textarea { width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px; }
        button:hover { background: #0056b3; }
        .btn-back { display: inline-block; margin-top: 20px; color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="card">
        <h1>My Profile</h1>

        <?php if ($message) echo "<div class='message'>$message</div>"; ?>
        <?php if ($error) echo "<div class='error'>$error</div>"; ?>

        <img src="<?php echo htmlspecialchars($profilePic); ?>" class="profile-img" alt="Profile">

        <form method="POST" enctype="multipart/form-data">
            <h3>Change Profile Picture</h3>
            <input type="file" name="profile_picture" accept="image/*">
            <br><br>

            <h3>About Me</h3>
            <textarea name="bio" rows="4"><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>
            <br>
            <button type="submit">Update Profile</button>
        </form>

        <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>
    </div>
</body>
</html>
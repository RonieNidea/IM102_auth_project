<?php
require_once 'auth_functions.php';
require_once 'db_connect.php';

requireLogin();

$username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
$role = $_SESSION['role'];
$userId = $_SESSION['user_id'];

// Get user data including profile picture
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Get profile picture path
$profilePic = $user['profile_picture'] && file_exists('uploads/profiles/' . $user['profile_picture'])
    ? 'uploads/profiles/' . $user['profile_picture']
    : 'https://via.placeholder.com/50?text=No+Photo';
?>

<!DOCTYPE html>
<html>
<head>
<title>User Dashboard</title>
<link rel="stylesheet" href="style.css">
<style>
    .header { display: flex; align-items: center; gap: 20px; margin-bottom: 30px; }
    .avatar { width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 3px solid #007bff; }
</style>
</head>

<body>

<div class="container">

<div class="header">
    <img src="<?php echo htmlspecialchars($profilePic); ?>" alt="Profile" class="avatar">
    <div>
        <h2>Welcome, <?php echo $username; ?>!</h2>
        <p>Role: <strong><?php echo htmlspecialchars($role); ?></strong></p>
    </div>
</div>

<p>This is your dashboard. Only logged-in users can access this page.</p>

<h3>Navigation</h3>

<ul>

<li><a href="profile.php">My Profile</a></li>
<li><a href="posts.php">View Posts</a></li>

<?php if ($role === 'admin'): ?>
<li><a href="admin_dashboard.php">Admin Dashboard</a></li>
<?php endif; ?>

<?php if ($role === 'editor'): ?>
<li><a href="editor_dashboard.php">Editor Dashboard</a></li>
<?php endif; ?>

<li><a href="logout.php">Logout</a></li>

</ul>

</div>

</body>
</html>
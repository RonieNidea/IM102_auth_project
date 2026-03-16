<?php
require_once 'auth_functions.php';

requireAdmin();
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h1>Admin Dashboard</h1>

<p>Welcome Admin, <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>!</p>

<h3>Admin Controls</h3>

<ul>
    <li><a href="admin_users.php">Manage Users</a></li>
    <li><a href="create_post.php">Create Post</a></li>
    <li><a href="posts.php">View All Posts</a></li>
</ul>

<hr>

<h3>Navigation</h3>

<ul>
    <li><a href="dashboard.php">User Dashboard</a></li>
    <li><a href="editor_dashboard.php">Editor Dashboard</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

</div>

</body>
</html>
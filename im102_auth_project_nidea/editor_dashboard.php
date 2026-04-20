<?php
require_once 'auth_functions.php';

requireRole('editor');
?>

<!DOCTYPE html>
<html>
<head>
<title>Editor Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>


<body>

<div class="container">
<h1>Editor Dashboard</h1>

<p>Welcome Editor, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>

<h3>Editor Tools</h3>

<ul>
<li><a href="create_post.php">Create Post</a></li>
<li><a href="posts.php">View Posts</a></li>
</ul>

<hr>

<a href="dashboard.php">User Dashboard</a> |
<a href="logout.php">Logout</a>

</div>

</body>
</html>
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

<p>Welcome Admin, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>

<h3>Admin Controls</h3>

<ul>
<li><a href="#">Manage Users</a></li>
<li><a href="#">System Settings</a></li>
<li><a href="#">View Reports</a></li>
</ul>

<hr>

<a href="dashboard.php">User Dashboard</a> |
<a href="logout.php">Logout</a>

</div>

</body>
</html>
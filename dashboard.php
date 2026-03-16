<?php
require_once 'auth_functions.php';

requireLogin();

$username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html>
<head>
<title>User Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h2>Welcome, <?php echo $username; ?>!</h2>
<p>This is your dashboard. Only logged-in users can access this page.</p>

<h3>Navigation</h3>

<ul>

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
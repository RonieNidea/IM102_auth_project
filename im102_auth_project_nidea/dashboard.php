<?php
require_once 'auth_functions.php';

requireLogin();

$username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Welcome, <?php echo $username; ?>!</h2>
    <p>This is your dashboard. Only logged-in users can access this page.</p>

    <!-- Role-Based Navigation -->
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <p><a href="admin_dashboard.php">Go to Admin Panel</a></p>
    <?php endif; ?>

    <p><a href="logout.php">Logout</a></p>
</div>

</body>
</html>
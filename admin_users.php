<?php
require_once 'auth_functions.php';
require_once 'db_connect.php';

requireAdmin();

$result = $conn->query("SELECT id,username,email,role FROM users");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Users</title>
</head>

<body>

<h1>User Management</h1>

<table border="1">

<tr>
<th>Username</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>
</tr>

<?php while($user = $result->fetch_assoc()): ?>

<tr>

<td><?php echo $user['username']; ?></td>
<td><?php echo $user['email']; ?></td>
<td><?php echo $user['role']; ?></td>

<td>

<?php if ($user['role'] !== 'admin'): ?>

<a href="change_role.php?id=<?php echo $user['id']; ?>&role=admin">
Make Admin
</a>

<?php endif; ?>

</td>

</tr>

<?php endwhile; ?>

</table>

<br>

<a href="admin_dashboard.php">Back</a>

</body>
</html>
<?php
require_once 'auth_functions.php';
require_once 'db_connect.php';

requireLogin();

$result = $conn->query("
SELECT posts.*, users.username 
FROM posts
JOIN users ON posts.author_id = users.id
ORDER BY created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>All Posts</title>
</head>

<body>

<h1>All Posts</h1>

<?php if (hasAnyRole(['admin','editor'])): ?>
<a href="create_post.php">Create Post</a>
<?php endif; ?>

<hr>

<?php while ($post = $result->fetch_assoc()): ?>

<div style="border:1px solid #ccc;padding:10px;margin:10px;">
<h3><?php echo $post['title']; ?></h3>
<p><?php echo $post['content']; ?></p>
<small>
By <?php echo $post['username']; ?>
</small>
</div>

<?php endwhile; ?>

<a href="dashboard.php">Back</a>

</body>
</html>
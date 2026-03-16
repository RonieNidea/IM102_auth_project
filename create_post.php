<?php
require_once 'auth_functions.php';
require_once 'db_connect.php';

if (!hasAnyRole(['admin','editor'])) {
    die("Access Denied!");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO posts (title, content, author_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $content, $author);
    $stmt->execute();

    echo "Post created successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Create Post</title>
</head>

<body>

<h2>Create Post</h2>

<form method="POST">
Title:<br>
<input type="text" name="title" required><br><br>

Content:<br>
<textarea name="content" rows="5"></textarea><br><br>

<button type="submit">Publish</button>
</form>

<br>
<a href="dashboard.php">Back</a>

</body>
</html>
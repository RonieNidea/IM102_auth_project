<?php
session_start();
require_once 'db_connect.php';

$errors = [];
$generic_error = "Invalid credentials.";  // Generic error message

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email'] ?? '');  // Only using email
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $errors[] = $generic_error;
    } else {

        // Check user with the given email only
        $stmt = $conn->prepare("SELECT id, username, password_hash FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {

            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password_hash'])) {

                // Prevent session fixation attack
                session_regenerate_id(true);

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header("Location: dashboard.php");
                exit();
            }
        }

        // Always return generic error
        $errors[] = $generic_error;  // Show "Invalid credentials" message

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <?php
    if (!empty($errors)) {
        echo "<p style='color:red;'>$errors[0]</p>";  // Display the generic error message
    }
    ?>

    <form method="post" action="login.php">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>

</body>
</html>
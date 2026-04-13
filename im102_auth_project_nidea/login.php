<?php
session_start();
require_once 'db_connect.php';
require_once 'validate.php';

$errors = [];
$generic_error = "Invalid credentials.";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Use validation function
    $errors = validateLogin($_POST);

    if (empty($errors)) {

        $email = trim($_POST['email']);
        $password = $_POST['password'];

        try {
            $stmt = $conn->prepare("SELECT id, username, password_hash, role FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {

                $user = $result->fetch_assoc();

                if (password_verify($password, $user['password_hash'])) {

                    session_regenerate_id(true);

                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];

                    if ($user['role'] === 'admin') {
                        header("Location: admin_dashboard.php");
                    } elseif ($user['role'] === 'editor') {
                        header("Location: editor_dashboard.php");
                    } else {
                        header("Location: dashboard.php");
                    }

                    exit();
                }
            }

            // Always generic error
            $errors[] = $generic_error;

        } catch (Exception $e) {
            logError($e->getMessage());
            $errors[] = "Something went wrong. Please try again.";
        }

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

    <?php if (!empty($errors)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($errors[0]); ?></p>
    <?php endif; ?>

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
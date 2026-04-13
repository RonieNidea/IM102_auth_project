<?php
// validate.php

function validateRegistration($data) {
    $errors = [];

    $username = trim($data['username'] ?? '');
    $email = trim($data['email'] ?? '');
    $password = $data['password'] ?? '';
    $confirm = $data['confirm_password'] ?? '';

    if (empty($username)) {
        $errors[] = "Username is required";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }

    if ($password !== $confirm) {
        $errors[] = "Passwords do not match";
    }

    return $errors;
}

function validateLogin($data) {
    $errors = [];

    if (empty($data['email'])) {
        $errors[] = "Email is required";
    }

    if (empty($data['password'])) {
        $errors[] = "Password is required";
    }

    return $errors;
}

// Error logging (Task 3)
function logError($message) {
    $date = date('Y-m-d H:i:s');
    $logMessage = "[$date] $message\n";
    file_put_contents('error.log', $logMessage, FILE_APPEND);
}
?>
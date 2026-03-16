<?php
session_start();

function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

function requireAdmin() {
    requireLogin();

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        die("Access Denied. Administrators only.");
    }
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

/* NEW FUNCTIONS */

function hasRole($role) {
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

function hasAnyRole($roles) {
    if (!isset($_SESSION['role'])) {
        return false;
    }

    return in_array($_SESSION['role'], $roles);
}

function requireRole($role) {
    requireLogin();

    if (!hasRole($role)) {
        die("Access Denied! Requires role: " . $role);
    }
}
?>
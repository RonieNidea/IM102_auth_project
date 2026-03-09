<?php
// auth_functions.php

function dbConnect() {
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'im102_db';
    
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $conn->set_charset("utf8mb4");
    return $conn;
}

function requireLogin() {
    session_start();
    
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
}

function requireAdmin() {
    requireLogin();
    
    if ($_SESSION['role'] !== 'admin') {
        die('Access Denied. Administrators only.');
    }
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}
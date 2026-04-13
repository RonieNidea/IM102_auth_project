<?php
require_once 'auth_functions.php';
require_once 'db_connect.php';

requireAdmin();

$id = $_GET['id'];
$role = $_GET['role'];

$stmt = $conn->prepare("UPDATE users SET role=? WHERE id=?");
$stmt->bind_param("si",$role,$id);
$stmt->execute();

header("Location: admin_users.php");
exit();
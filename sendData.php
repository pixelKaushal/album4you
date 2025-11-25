<?php
session_start();
require_once 'db.php';
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();
$_SESSION['address'] = $userData['address'];
$_SESSION['pw'] = $userData['password'];
$_SESSION['phone_number'] = $userData['phone_number'];
$_SESSION['social_link'] = $userData['social_link'];
$_SESSION['contact_method'] = $userData['contact_method'];
$_SESSION['contact_time'] = $userData['contact_time'];
$_SESSION['notes'] = $userData['notes'];

header("Content-Type: application/json");
$username = $_SESSION['username'] ?? null;
echo json_encode([
    'username' => $username ?? null,
    'email' => $_SESSION['email'] ?? null,
    'loggedin' => $_SESSION['loggedin'] ?? false,
    'address' => $_SESSION['address'] ?? null,
    'phone_number' => $_SESSION['phone_number'] ?? null,
    'social_link' => $_SESSION['social_link'] ?? null,
    'contact_method' => $_SESSION['contact_method'] ?? null,
    'contact_time' => $_SESSION['contact_time'] ?? null,
    'notes' => $_SESSION['notes'] ?? null

]);

?>
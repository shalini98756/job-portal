<?php
// Show all PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    // Validate form
    if (empty($username) || empty($password) || empty($confirm)) {
        echo "Please fill in all fields.";
        exit;
    }

    if ($password !== $confirm) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash password
    $hashedPassword = hash('sha256', $password);

    // Check for existing user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        echo "Username already exists.";
        exit;
    }

    // Insert user
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt->execute([$username, $hashedPassword])) {
        echo "✅ Registration successful! <a href='login.html'>Login here</a>";
    } else {
        echo "❌ Failed to register user. Try again.";
    }
} else {
    echo "⚠️ No POST data received.";
}

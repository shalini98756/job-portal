
<?php


// Show all errors during development
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Optional: Log all incoming POST data to a file for debugging
file_put_contents('debug_log.txt', print_r($_POST, true), FILE_APPEND);

// Database connection config
$host = "localhost";
$username = "root";
$password = "shalini@8675"; // use your real password
$database = "index";        // your database name

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo "Database connection failed: " . $conn->connect_error;
    exit;
}

// Get and sanitize form input
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validate required fields
if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo "Please fill in all required fields.";
    exit;
}

// Prepare SQL insert statement
$stmt = $conn->prepare("INSERT INTO contact_form (name, email, subject, message) VALUES (?, ?, ?, ?)");

if (!$stmt) {
    http_response_code(500);
    echo "Failed to prepare SQL statement: " . $conn->error;
    exit;
}

// Bind and execute
$stmt->bind_param("ssss", $name, $email, $subject, $message);

if ($stmt->execute()) {
    echo "Message sent successfully!";
} else {
    http_response_code(500);
    echo "Failed to save message: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

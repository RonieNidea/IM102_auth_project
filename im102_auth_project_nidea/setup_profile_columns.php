<?php
// Add profile_picture and bio columns to users table

$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = '';
$db_name = 'im102_db';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add profile_picture column
$sql1 = "ALTER TABLE users ADD COLUMN profile_picture VARCHAR(255) DEFAULT NULL";
if ($conn->query($sql1) === TRUE) {
    echo "profile_picture column added successfully<br>";
} else {
    if (strpos($conn->error, "Duplicate column") === false) {
        echo "Error adding profile_picture column: " . $conn->error . "<br>";
    } else {
        echo "profile_picture column already exists<br>";
    }
}

// Add bio column
$sql2 = "ALTER TABLE users ADD COLUMN bio TEXT DEFAULT NULL";
if ($conn->query($sql2) === TRUE) {
    echo "bio column added successfully<br>";
} else {
    if (strpos($conn->error, "Duplicate column") === false) {
        echo "Error adding bio column: " . $conn->error . "<br>";
    } else {
        echo "bio column already exists<br>";
    }
}

$conn->close();
echo "<p><strong>Database updated!</strong></p>";
echo "<p><a href='dashboard.php'>Go to Dashboard</a></p>";
?>

<?php
// Initialize uploads folder with proper permissions
$uploadsDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
$profilesDir = $uploadsDir . 'profiles' . DIRECTORY_SEPARATOR;

echo "<h2>Setting up uploads directory...</h2>";

// Create uploads folder if it doesn't exist
if (!is_dir($uploadsDir)) {
    if (mkdir($uploadsDir, 0777, true)) {
        echo "<p>✓ Created uploads/ directory</p>";
    } else {
        echo "<p>✗ Failed to create uploads/ directory</p>";
    }
} else {
    echo "<p>✓ uploads/ directory already exists</p>";
}

// Create profiles folder if it doesn't exist
if (!is_dir($profilesDir)) {
    if (mkdir($profilesDir, 0777, true)) {
        echo "<p>✓ Created uploads/profiles/ directory</p>";
    } else {
        echo "<p>✗ Failed to create uploads/profiles/ directory</p>";
    }
} else {
    echo "<p>✓ uploads/profiles/ directory already exists</p>";
}

// Set permissions to be writable
@chmod($uploadsDir, 0777);
@chmod($profilesDir, 0777);

// Create a .gitkeep file so the directory is tracked
file_put_contents($profilesDir . '.gitkeep', '');

// Verify setup
echo "<h3>Verification:</h3>";
echo "<p>uploads/ exists: " . (is_dir($uploadsDir) ? "YES ✓" : "NO ✗") . "</p>";
echo "<p>uploads/ writable: " . (is_writable($uploadsDir) ? "YES ✓" : "NO ✗") . "</p>";
echo "<p>profiles/ exists: " . (is_dir($profilesDir) ? "YES ✓" : "NO ✗") . "</p>";
echo "<p>profiles/ writable: " . (is_writable($profilesDir) ? "YES ✓" : "NO ✗") . "</p>";

echo "<h3>Setup complete! You can now <a href='profile.php'>upload your profile picture</a></h3>";
?>

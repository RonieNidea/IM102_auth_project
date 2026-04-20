<?php
// Debug uploads folder issue
$uploadDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profiles' . DIRECTORY_SEPARATOR;
$uploadsDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;

echo "<h2>Upload Directory Debug</h2>";
echo "<p><strong>Base Dir:</strong> " . htmlspecialchars(__DIR__) . "</p>";
echo "<p><strong>Uploads Dir:</strong> " . htmlspecialchars($uploadsDir) . "</p>";
echo "<p><strong>Profiles Dir:</strong> " . htmlspecialchars($uploadDir) . "</p>";

echo "<h3>Directory Checks</h3>";
echo "<p>uploads/ exists: " . (file_exists($uploadsDir) ? "YES ✓" : "NO ✗") . "</p>";
echo "<p>profiles/ exists: " . (file_exists($uploadDir) ? "YES ✓" : "NO ✗") . "</p>";
echo "<p>uploads/ is_dir: " . (is_dir($uploadsDir) ? "YES ✓" : "NO ✗") . "</p>";
echo "<p>profiles/ is_dir: " . (is_dir($uploadDir) ? "YES ✓" : "NO ✗") . "</p>";
echo "<p>uploads/ writable: " . (is_writable($uploadsDir) ? "YES ✓" : "NO ✗") . "</p>";
echo "<p>profiles/ writable: " . (is_writable($uploadDir) ? "YES ✓" : "NO ✗") . "</p>";

// List contents
echo "<h3>Directory Contents</h3>";
if (file_exists($uploadDir)) {
    $files = @scandir($uploadDir);
    echo "<p><strong>profiles/ contents:</strong></p>";
    echo "<ul>";
    if ($files !== false) {
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                echo "<li>" . htmlspecialchars($file) . "</li>";
            }
        }
    } else {
        echo "<li>Cannot read directory</li>";
    }
    echo "</ul>";
}
?>

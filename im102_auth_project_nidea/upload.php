<?php
// upload.php

function uploadProfilePicture($file) {
    // Check if file exists
    if ($file['error'] === 4) {
        return ['error' => 'No file selected'];
    }
    
    // Check for upload error
    if ($file['error'] !== 0) {
        return ['error' => 'Upload failed. Error code: ' . $file['error']];
    }
    
    // Check file size (max 2MB)
    $maxSize = 2 * 1024 * 1024;
    if ($file['size'] > $maxSize) {
        return ['error' => 'File too big! Max 2MB only.'];
    }
    
    // Check file type (only images)
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowedTypes)) {
        return ['error' => 'Only JPG, PNG, GIF allowed!'];
    }
    
    // Get absolute path to uploads directory
    $uploadDir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profiles' . DIRECTORY_SEPARATOR;
    
    // Make sure directory exists (recursive create with chmod)
    if (!is_dir($uploadDir)) {
        @mkdir($uploadDir, 0777, true);
        @chmod($uploadDir, 0777);
    }
    
    // Verify directory is writable
    if (!is_writable($uploadDir)) {
        // Try to fix permissions
        @chmod($uploadDir, 0777);
        if (!is_writable($uploadDir)) {
            return ['error' => 'Upload directory not writable. Run setup_uploads.php first.'];
        }
    }
    
    // Generate safe filename
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $newName = 'profile_' . time() . '_' . rand(100000, 999999) . '.' . $extension;
    $destination = $uploadDir . $newName;
    
    // Move uploaded file
    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        return ['error' => 'Could not move file to uploads directory.'];
    }
    
    // Make sure uploaded file is readable
    @chmod($destination, 0644);
    
    return ['success' => true, 'filename' => $newName];
}
?>




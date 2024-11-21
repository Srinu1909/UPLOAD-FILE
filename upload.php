<?php
// Define allowed file types
$allowedTypes = ['image/jpeg', 'image/png', 'application/pdf']; // Example allowed types
$maxFileSize = 5 * 1024 * 1024; // Max file size (5MB)

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Check if file was uploaded without errors
    if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] == 0) {
        $file = $_FILES['fileUpload'];
        $filename = basename($file['name']); // Get the original file name
        $fileType = mime_content_type($file['tmp_name']); // Get the file's MIME type
        $fileSize = $file['size']; // Get the file size in bytes
        $targetDir = "uploads/"; // Define the target directory

        // Check if file type is allowed
        if (!in_array($fileType, $allowedTypes)) {
            echo "Error: Invalid file type. Only JPG, PNG, and PDF files are allowed.";
            exit;
        }

        // Check if file size is within the allowed limit
        if ($fileSize > $maxFileSize) {
            echo "Error: File size exceeds the maximum allowed size of 5MB.";
            exit;
        }

        // Ensure the upload directory exists, if not, create it
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Create a unique filename to prevent overwriting existing files
        $uniqueFilename = time() . '-' . $filename;
        $targetFilePath = $targetDir . $uniqueFilename;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            echo "The file " . htmlspecialchars($filename) . " has been uploaded successfully as " . htmlspecialchars($uniqueFilename) . ".";
        } else {
            echo "Error: Unable to move the uploaded file.";
        }
    } else {
        echo "Error: File upload failed. Error code: " . $_FILES['fileUpload']['error'];
    }
} else {
    echo "No file uploaded.";
}
?>

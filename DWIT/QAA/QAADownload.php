<?php
session_start();
require_once('../system/config.php');
if (!isset($_SESSION['user_authenticated']) || !$_SESSION['user_authenticated']) {
    header("Location: QAALogin.php"); // Redirect to the login page
    exit();
}

// Check if the filename parameter is provided in the URL
if (isset($_GET['filename'])) {
    // Sanitize the filename to prevent directory traversal attacks
    $filename = basename($_GET['filename']);
    $filepath = 'QAAUploads/' . $filename;

    // Check if the file exists
    if (file_exists($filepath)) {
        // Set the appropriate headers for file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));

        // Read the file and output it to the browser
        readfile($filepath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}
?>

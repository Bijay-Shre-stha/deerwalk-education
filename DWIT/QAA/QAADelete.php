<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user_authenticated']) || !$_SESSION['user_authenticated']) {
    header("Location: QAALogin.php"); // Redirect to the login page
    exit();
}

require_once('../system/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['file_id'])) {
        $fileId = $_POST['file_id'];

        try {
            $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Get the filename from the database
            $stmt = $conn->prepare("SELECT filename FROM uploads WHERE id = :file_id");
            $stmt->bindParam(":file_id", $fileId);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $filename = $result['filename'];

                // Delete file from the server
                $filePath = "QAAUploads/" . $filename;
                if (file_exists($filePath)) {
                    unlink($filePath); // Delete the file
                }

                // Delete file from the database
                $stmt = $conn->prepare("DELETE FROM uploads WHERE id = :file_id");
                $stmt->bindParam(":file_id", $fileId);
                $stmt->execute();

                // Additional logic if needed

                header("Location: QAAShow.php");
                exit();
            }
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
        }
    }
}

// Redirect to the show page if no valid file ID is provided
header("Location: QAAShow.php");
exit();
?>

<?php
session_start();

if (!isset($_SESSION['user_authenticated']) || !$_SESSION['user_authenticated']) {
    header("Location: QAALogin.php");
    exit();
}

require_once('../system/config.php');
ini_set('upload_max_filesize', '2G');
ini_set('post_max_size', '2G');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "QAAUploads/";

    // Create the target directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Get the uploaded file information
    $fileName = basename($_FILES["fileToUpload"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if the file type is allowed
    $allowedFileTypes = array("zip", "pdf", "doc", "docx", "txt");

    if (in_array($fileType, $allowedFileTypes)) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
            try {
                $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Insert file information into the database
                $stmt = $conn->prepare("INSERT INTO uploads (filename, upload_date, title, description) VALUES (:filename, NOW(), :title, :description)");
                $stmt->bindParam(":filename", $fileName);
                $stmt->bindParam(":title", $_POST['title']);
                $stmt->bindParam(":description", $_POST['description']);
                $stmt->execute();

                // Send the upload progress to the client
                echo json_encode(["status" => "success", "progress" => 100]);
            } catch (PDOException $e) {
                echo json_encode(["status" => "error", "message" => "Database connection failed: " . $e->getMessage()]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Sorry, there was an error uploading your file."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Only ZIP, PDF, DOC, DOCX, and TXT files are allowed. Max File size is 2GB."]);
    }
}
?>

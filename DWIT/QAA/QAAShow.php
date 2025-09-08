<?php
session_start();

// var_dump($_SESSION);
// Check if the user is authenticated
if (!isset($_SESSION['user_authenticated']) || !$_SESSION['user_authenticated']) {
    header("Location: QAALogin.php"); // Redirect to the login page
    exit();
}

require_once('../system/config.php');


// Database connection
try {
    $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all files from the database
    $stmt = $conn->prepare("SELECT id,title,description, filename, upload_date FROM uploads");
    $stmt->execute();
    $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
<!-- HTML......................................... -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon" >
    <title>QAA Files</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">QAA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                    
                <li class="nav-item">
                    <a class="nav-link" href="QAALogout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2>List of Uploaded Files </h2>
    <a class="btn btn-success" href="QAAUpload.php">Upload</a>
    <?php if (!empty($files)) : ?>
    <table class="table">
        <thead>
            <tr>
            <th>SN</th>
            <th>Title</th>
            <th>Description</th>
            <th>Filename</th>
            <th>Upload Date</th>
            <th >Action</th>
            </tr>
        </thead>
        
        <tbody>
                <?php 
                $serialNumber = 1;
                foreach ($files as $file) : ?>
                    <tr>
                        <td><?php echo $serialNumber++; ?></td>
                        <td><?php echo $file['title']; ?></td>
                        <td><?php echo $file['description']; ?></td>
                        <td><?php echo $file['filename']; ?></td>
                        <td><?php echo $file['upload_date']; ?></td>
                        <td>
                            <form action="QAADelete.php" method="post" id="deleteForm">
                                <input type="hidden" name="file_id" value="<?php echo $file['id']; ?>">
                                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                                <a class="btn btn-primary" href="QAADownload.php?filename=<?php echo $file['filename']; ?>">Download</a>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
    </table>
    <?php else : ?>
        <p>No files found.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function confirmDelete() {
        if (confirm("Are you sure you want to delete?")) {
            document.getElementById("deleteForm").submit();
        } else {
            
        }
    }

</script>

</body>
</html>








<!-- Old running code ...................... -->


</html>
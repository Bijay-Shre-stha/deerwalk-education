<?php
session_start();
if (!isset($_SESSION['user_authenticated']) || !$_SESSION['user_authenticated']) {
    header("Location: QAALogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Form</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <style>
        .progress {
            height: 20px;
            width: 100%;
            background-color: #6c757d;
            /* Background color of the progress bar */
        }

        #uploadProgressBar {
            background-color: #28a745;
            /* Progress bar color */
            height: 100%;
            width: 0;
            transition: width 0.3s ease;
            /* Add a smooth transition effect */
        }

        #uploadSpeed {
            display: block;
            margin-top: 5px;
        }

        #cancelButton {
            display: none;
            /* Initially hide the cancel button */
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="QAAShow.php">Home</a>
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
        <form id="uploadForm" action="QAAUploadProcess.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="fileToUpload" class="form-label">Select a File:</label>
                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" accept=".zip, .pdf, .doc, .docx, .txt" required>
            </div>
            <div class="mb-3">
                <div class="progress">
                    <div id="uploadProgressBar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span id="uploadSpeed"></span>
            </div>
            <button type="submit" name="submit" class="btn btn-success">Upload</button>
            <button type="button" id="cancelButton" class="btn btn-danger">Cancel</button>
        </form>
    </div>

    <!-- Include Bootstrap JS (if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            var startTime;
            var startBytes;
            var cancelUpload = false;
            var xhr; // Declare the XMLHttpRequest object globally

            $("#uploadForm").submit(function (e) {
                e.preventDefault();
                cancelUpload = false;

                // Show the cancel button when the file upload starts
                $("#cancelButton").show();

                var formData = new FormData(this);

                // Add a cancel button click event
                $("#cancelButton").off('click').on('click', function () {
                    var userDecision = confirm("Are you sure you want to cancel the upload?\nChoosing 'OK' will cancel the upload, and 'Cancel' will allow it to continue.");
                    if (userDecision) {
                        cancelUpload = true;
                        // Hide the cancel button after cancellation
                        $("#cancelButton").hide();
                        // Reset the progress bar
                        $("#uploadProgressBar").width("0%");
                        $("#uploadSpeed").text("");
                        // Abort the upload if it's in progress
                        if (xhr) {
                            xhr.abort();
                        }
                    }
                });

                xhr = $.ajax({
                    type: 'POST',
                    url: 'QAAUploadProcess.php',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    xhr: function () {
                        xhr = new window.XMLHttpRequest();
                        startTime = new Date().getTime();
                        startBytes = 0;

                        // Upload progress
                        xhr.upload.addEventListener("progress", function (evt) {
                            if (cancelUpload) {
                                var userDecision = confirm("Upload is in progress. Are you sure you want to cancel?\nChoosing 'OK' will cancel the upload, and 'Cancel' will allow it to continue.");
                                if (userDecision) {
                                    xhr.abort(); // Abort the upload if the cancel button is clicked and user confirms
                                    // Hide the cancel button after cancellation
                                    $("#cancelButton").hide();
                                    // Reset the progress bar
                                    $("#uploadProgressBar").width("0%");
                                    $("#uploadSpeed").text("");
                                }
                            }

                            if (evt.lengthComputable && !cancelUpload) {
                                var currentTime = new Date().getTime();
                                var elapsedMillis = currentTime - startTime;
                                var percentComplete = (evt.loaded / evt.total) * 100;
                                $("#uploadProgressBar").width(percentComplete + "%");

                                var uploadSpeed = (evt.loaded - startBytes) / elapsedMillis * 1000; // Bytes per second
                                startBytes = evt.loaded;

                                $("#uploadSpeed").text((uploadSpeed / 1024).toFixed(2) + " KB/s");
                            }
                        }, false);

                        return xhr;
                    },
                    success: function (response) {
                        if (response.status === "success") {
                            alert("File uploaded successfully!");

                            // Redirect to QAAShow.php after the user clicks "OK"
                            window.location.href = 'QAAShow.php';
                        } else {
                            // Check if the error is due to cancellation
                            if (!cancelUpload) {
                                alert("Error: " + response.message);
                            }
                        }
                    },
                    error: function (xhr, status, error) {
                        // Check if the error is due to cancellation
                        if (!cancelUpload && xhr.statusText !== "abort") {
                            alert("Error: " + error);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>

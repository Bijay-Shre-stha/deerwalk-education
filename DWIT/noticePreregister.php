<?php include './include/header.php'; ?>

<div class="container-fluid">
    <?php echo(Page_finder::get_message()); ?>
    <br>
</div>

<?php include './include/footer.php'; ?>

<script>
    // Set the timeout duration in milliseconds (e.g., 5000 for 5 seconds)
    var timeoutDuration = 2000; // Adjust this as needed

    // Function to redirect after the timeout
    function redirect() {
        window.location.href = "./admission.php"; // Redirect to the index.php page in the same directory
    }

    // Set the timeout
    setTimeout(redirect, timeoutDuration);
</script>

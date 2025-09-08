<?php
$pgName = '404 Page not Found';
include('./include/header.php') ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="error-notice">
            <h4>404 | PAGE NOT FOUND</h4>
            <p>The page you are looking for might have been removed, had its name changed or is temporarily unavailable.</p>
                <a href="index.php"><button class="btn btn-primary error-btn">HOME</button></a>
            </div>
        </div>

        <div class="col-md-4 error-bg">

                <img src="assets/images/page-not-found.png" class="error-img img-fluid">

        </div>
    </div>
</div>




<?php include('./include/footer.php') ?>


<?php

require("../system/application_top.php");


if (isset($_SESSION['authid'])) {
    header("location:index.php");
}

if ($obj->getREQUEST('submit')) {
    $email = $obj->StringInputCleaner($_POST['email']);
    $password = $obj->StringInputCleaner($_POST['password']);
    $msg = $user->checkLogin($email, $password);
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="assets/icons/logo.png">
    <link rel="stylesheet" type="text/css" href="assets/css/loginStyle.css">
    <script src="https://kit.fontawesome.com/0fa86ee952.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="./assets/js/loginValidate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
    <style type="text/css">


    </style>
</head>
<body background="assets/images/login_background.jpg">
<div class="container-self">
    <div class="box">
        <div class="logo">
            <img src="assets/icons/loginlogo1.png" width="150">
        </div>

        <div class="content">
            <p><u>This site credentials is only for College Administration</u></p>
            <form action="" method="POST" id="loginMe">
                <label for="email"><i class="fas fa-user fa-2x"></i></label>
                <input type="email" name="email" id="email" placeholder="Enter Email" required="required"><br>
                <label id="email-error" class="error" for="email"></label><br>

                <label for="password"><i class="fas fa-envelope fa-2x"></i></label>
                <input type="password" name="password" id="password" placeholder="Enter the password"
                       required="required"><br>
                <label id="password-error" class="error" for="password"></label><br>

                <input type="hidden" name="submit" value="submit">

                <?php
                $status = $user->check_attempt();
                if ($status == "Allow") {
                    ?>

                    <script type="text/javascript">
                        document.write("<button type=\"submit\">LOGIN <i class=\"far fa-paper-plane\"></i></button>");
                    </script>
                <?php echo Page_finder::get_message(); ?>
                    <noscript>
                        <p style="color: red;"><b><i>Please enable JavaScript to continue</i></b>
                        <p>
                    </noscript>

                <?php }else{
                ?>
                    <div class="alert alert-danger" role="alert">
                        You have been blocked. Please contact system administrator!!!
                    </div>
                <?php } ?>
            </form>
        </div>
        <!-- content -->
    </div>
    <!-- box -->
</div>
<!-- container -->
</body>
</html>
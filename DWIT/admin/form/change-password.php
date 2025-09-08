<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


$id = $_SESSION['authid'];
?>

<h2 class="text-center">Change Password</h2>

<form action="?fold=actpages&page=act_user" id="change-password" method="POST">
    <div class="form-group">
        <label for="title">Old Password</label>
        <input type="password" class="form-control" id="oldPass" placeholder="Enter your old password" name="oldPass">
        <label id="oldPass-error" class="error invalid-feedback" for="oldPass"></label>
    </div>

    <div class="form-group">
        <label for="title">New Password</label>
        <input type="password" class="form-control" id="newPass" placeholder="Enter your new password" name="newPass">
        <label id="newPass-error" class="error invalid-feedback" for="newPass"></label>
    </div>

    <div class="form-group">
        <label for="title">Re-Password</label>
        <input type="password" class="form-control" id="rePass" placeholder="Re-Enter your new password" name="rePass">
        <label id="rePass-error" class="error invalid-feedback" for="rePass"></label>
    </div>

    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="action" value="update">


    <script type="text/javascript">
        document.write("<button type=\"submit\" name=\"formSubmitted\" class=\"btn btn-primary\">Update</button>");
    </script>
    <noscript>
        <p style="color: red;"><b><i>Please enable JavaScript to continue</i></b>
        <p>
    </noscript>
</form>
<?php
$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

?>

<h2 class="text-center">Add User</h2>
<form action="?fold=actpages&page=act_user" id="add-user" method="POST">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="fullname">
        <label id="name-error" class="error invalid-feedback" for="name"></label>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
        <label id="email-error" class="error invalid-feedback" for="email"></label>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
        <label id="password-error" class="error invalid-feedback" for="password"></label>
    </div>

    <div class="form-group">
        <label for="repassword">Re Enter Your Password:</label>
        <input type="password" class="form-control" id="repassword" placeholder="Re-Enter your password"
               name="repassword">
        <label id="repassword-error" class="error invalid-feedback" for="repassword"></label>
    </div>

    <div class="form-group">
        <label for="role">Role:</label>
        <select class="form-control" id="role" name="type">
            <option selected disabled>--Select Role--</option>
            <option value=admin>Admin</option>
        </select>
        <label id="role-error" class="error invalid-feedback" for="role"></label>
    </div>

    <input type="hidden" name="action" value="add">

    <script type="text/javascript">
        document.write("<button type=\"submit\" name=\"formSubmitted\" class=\"btn btn-primary\">Save</button>");
    </script>

    <noscript>
        <p style="color: red;"><b><i>Please enable JavaScript to continue</i></b>
        <p>
    </noscript>

</form>
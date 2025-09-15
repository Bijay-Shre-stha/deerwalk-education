<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


?>


<h2 class="text-center">Add New Prospectus</h2>

<form action="?fold=actpages&page=act_prospectus" id="add-prospectus" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
        <label id="name-error" class="error invalid-feedback" for="name"></label>
    </div>

    <div class="form-group">
        <label for="year">Year:</label>
        <input type="number" class="form-control" id="year" placeholder="Enter year" name="year" min="2000" max="2100" step="1">
        <label id="year-error" class="error invalid-feedback" for="year"></label>
    </div>

    <div class="form-group">
        <label for="file">File:</label>
        <input type="file" name="file" class="form-control" id="file" required="required">
        <label id="file-error" class="error invalid-feedback" for="file"></label>
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


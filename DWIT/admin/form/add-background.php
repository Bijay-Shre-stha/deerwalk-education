<?php
$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");
?>

<h2 class="text-center">Add Background</h2>
<form action="?fold=actpages&page=act_background" id="add-background" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control" id="image" placeholder="Select background Image" name="image">
        <label id="image-error" class="error invalid-feedback" for="image"></label>
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

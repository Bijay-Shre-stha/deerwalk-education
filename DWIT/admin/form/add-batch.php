<?php
$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

if (isset($_GET['bid'])) {
    $id = (int)$_GET['bid'];
    $oldData = $obj->getFieldDataById("batch", array("name"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>

<h2 class="text-center">Add Batch</h2>
<form action="?fold=actpages&page=act_batch" id="add-batch" method="POST">
    <div class="form-group">
        <label for="batch">Name:</label>
        <input type="text" class="form-control" id="batch" placeholder="Enter batch name" name="batch" value="<?php if (isset($oldData)) echo $oldData['name']; ?>">
        <label id="batch-error" class="error invalid-feedback" for="batch"></label>
    </div>

<!--     <input type="hidden" name="action" value="add"> -->

    <?php if (isset($oldData)) { ?><input type="hidden" name="id" value="<?php echo $id; ?>"><?php } ?>
    <input type="hidden" name="action" value="<?php echo $action; ?>">

    <?php if ($action == "edit") { ?>
        <script type="text/javascript">
            document.write("<button type=\"submit\" name=\"formSubmitted\" class=\"btn btn-primary\">Update</button>");
        </script>
    <?php }else{ ?>
        <script type="text/javascript">
            document.write("<button type=\"submit\" name=\"formSubmitted\" class=\"btn btn-primary\">Save</button>");
        </script>
    <?php } ?>

    <noscript>
        <p style="color: red;"><b><i>Please enable JavaScript to continue</i></b>
        <p>
    </noscript>

</form>

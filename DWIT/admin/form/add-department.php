<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_GET['did'])) {
    $id = (int)$_GET['did'];
    $oldData = $obj->getFieldDataById("department", array("name", "description"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>

<h2 class="text-center">Add Department</h2>

<form action="?fold=actpages&page=act_department" id="add-department" method="POST">
    <div class="form-group">
        <label for="departmentName">Department Name:</label>
        <input type="text" class="form-control error" id="departmentName" placeholder="Enter department name"
               name="departmentName" value="<?php if (isset($oldData)) echo $oldData['name']; ?>">
        <label id="departmentName-error" class="error invalid-feedback" for="departmentName"></label>
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" placeholder="Enter description here..." name="description"
                  required rows="5"><?php if (isset($oldData)) echo $oldData['description']; ?></textarea>
        <label id="description-error" class="error invalid-feedback" for="description"></label>
    </div>

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
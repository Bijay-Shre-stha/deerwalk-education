<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_GET['aid'])) {
    $id = (int)$_GET['aid'];
    $oldData = $obj->getFieldDataById("memberBio", array("name", "bio"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>
<h2 class="text-center">Add Member Bio</h2>
<form action="?fold=actpages&page=act_bio" id="add-bio" method="POST" enctype="multipart/form-data">
<div class="form-group">
    <label for="name">Name:</label>
    <input type="text" id="name" class="form-control" placeholder="Enter member name" name="name" 
    value="<?php if (isset($oldData)) echo $oldData['name']; ?>">
</div>
    <input type="hidden" name="action" value=<?php echo $action;?>>
<div class="form-group">
    <label for="introduction">Bio: </label>
    <textarea class="form-control" id="bio" name="bio"><?php if (isset($oldData)) echo $oldData['bio']; ?></textarea>
</div>
    <?php if (isset($oldData)) { ?><input type="hidden" name="id" value="<?php echo $id; ?>"><?php } ?>
    <?php if ($action == "edit") { ?>
        <script type="text/javascript">
            document.write("<button type=\"submit\" name=\"formSubmitted\" class=\"btn btn-primary\">Update</button>");
        </script>
    <?php }else{ ?>
        <script type="text/javascript">
            document.write("<button type=\"submit\" name=\"formSubmitted\" class=\"btn btn-primary\">Save</button>");
        </script>
    <?php } ?>
</form>
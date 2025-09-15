<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_GET['aid'])) {
    $id = (int)$_GET['aid'];
    $oldData = $obj->getFieldDataById("clubs", array("name", "introduction", "club_vision","club_mission"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>
<h2 class="text-center">Add Club</h2>
<form action="?fold=actpages&page=act_club" id="add-club" method="POST" enctype="multipart/form-data">
<div class="form-group">
    <label for="club-name">Club:</label>
    <input type="text" id="club-name" class="form-control" placeholder="Enter club name" name="club-name" 
    value="<?php if (isset($oldData)) echo $oldData['name']; ?>">
</div>
    <input type="hidden" name="action" value=<?php echo $action;?>>
    <div class="form-group">
        <label for="introduction">Introduction: </label>
        <textarea class="form-control" id="introduction" name="introduction"><?php if (isset($oldData)) echo $oldData['introduction']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="club-vision">Club Vision: </label>
        <textarea class="form-control" id="club-vision" name="club-vision"><?php if (isset($oldData)) echo $oldData['club_vision']; ?></textarea>
    </div>
    <?php if (isset($oldData)) { ?><input type="hidden" name="id" value="<?php echo $id; ?>"><?php } ?>
    <input type="hidden" name="action" value="<?php echo $action; ?>">
    <div class="form-group">
        <label for="club-mission">Club Mission: </label>
        <textarea class="form-control" id="club-mission" name="club-mission"><?php if (isset($oldData)) echo $oldData['club_mission']; ?></textarea>
    </div>
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
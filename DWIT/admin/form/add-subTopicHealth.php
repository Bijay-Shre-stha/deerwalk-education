<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

if (isset($_GET['tid'])) {
    $id = (int)$_GET['tid'];
    $action = "add";
} elseif(isset($_GET['sid'])) {
    $id = (int)$_GET['sid'];
    $oldData = $obj->getFieldDataById("sub_health_diploma", array("id", "title", "description", "priority"), $id);
    $action = "edit"; 
}
else {
    die();
}

?>

<h2 class="text-center">Add Sub - Topic</h2>

<form action="?fold=actpages&page=act_subTopicHealth" id="add-subTopicHealth" method="POST">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control error" id="title" placeholder="Enter title" name="title"
               value="<?php if (isset($oldData)) echo $oldData['title']; ?>">
        <label id="title-error" class="error invalid-feedback" for="title"></label>
    </div>

    <div class="form-group">
        <label for="priority">Priority</label>
        <input type="number" class="form-control error" id="priority" placeholder="Enter priority order" name="priority"
               value="<?php if (isset($oldData)) echo $oldData['priority']; ?>">
        <label id="priority-error" class="error invalid-feedback" for="priority"></label>
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control cust-editor" id="description" placeholder="Enter description here..." name="description" required
                  rows="5"><?php if (isset($oldData)) echo $oldData['description']; ?></textarea>
        <label id="description-error" class="error invalid-feedback" for="description"></label>
    </div>

   
    <input type="hidden" name="id" value="<?php echo $id; ?>">
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
        <p style="color: red;"><b><i>Please enable JavaScript to continue</i></b></p>
    </noscript>

</form>
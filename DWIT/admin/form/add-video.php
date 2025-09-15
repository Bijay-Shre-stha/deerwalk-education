<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_GET['vid'])) {
    $id = (int)$_GET['vid'];
    $oldData = $obj->getFieldDataById("youtube_video", array("title", "link"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>


<h2 class="text-center">Add Video</h2>

<form action="?fold=actpages&page=act_video" id="add-video" method="POST">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" placeholder="Enter title" name="title"
               value="<?php if (isset($oldData)) echo $oldData['title']; ?>">
        <label id="title-error" class="error invalid-feedback" for="title"></label>
    </div>
    <div class="form-group">
        <label for="urlAddress">Video URL:</label>
        <input type="url" class="form-control" id="urlAddress" placeholder="Enter the link of video" name="urlAddress"
               value="<?php if (isset($oldData)) echo $oldData['link']; ?>">
        <label id="urlAddress-error" class="error invalid-feedback" for="urlAddress"></label>
    </div>

    <?php if (isset($oldData)) { ?><input type="hidden" name="id" value="<?php echo $id; ?>"><?php } ?>
    <input type="hidden" name="action" value="<?php echo $action; ?>">


    <?php if ($action == "edit") { ?>
        <script type="text/javascript">
            document.write("<button type=\"submit\" name=\"formSubmitted\" class=\"btn btn-primary\">Update</button>");
        </script>
    <?php }else{ ?>
        <script type="text/javascript">
            document.write("<button type=\"submit\" name=\"formSubmitted\" class=\"btn btn-primary\">Add</button>");
        </script>
    <?php } ?>


    <noscript>
        <p style="color: red;"><b><i>Please enable JavaScript to continue</i></b>
        <p>
    </noscript>
</form>
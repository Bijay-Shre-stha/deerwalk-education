<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_GET['aid'])) {
    $id = (int)$_GET['aid'];
    $oldData = $obj->getFieldDataById("article_post", array("content", "title", "image_name"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>


<h2 class="text-center">Add Article</h2>

<form action="?fold=actpages&page=act_article" id="add-article" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" placeholder="Enter title" name="title"
               value="<?php if (isset($oldData)) echo $oldData['title']; ?>">
        <label id="title-error" class="error invalid-feedback" for="title"></label>
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control" id="image"
               name="image" <?php if (!isset($oldData)) echo "required"; ?> >
        <label id="image-error" class="error invalid-feedback" for="image"></label>
        <?php if (isset($oldData)): ?>
            <p style="color: red;">*Select New Image only to change the previous image</p>
            <img src="uploads/articles/<?php echo $oldData['image_name']; ?>" alt="articles" width=100
                 style="margin-top: 15px;">
            <p style="color: green;"><u>Previous Image</u></p>
        <?php endif ?>
    </div>
    <div class="form-group">
        <label for="content">Content:</label>
        <textarea class="form-control cust-editor" id="content" placeholder="Enter content here..." name="content" rows="10"
                  required="required"><?php if (isset($oldData)) echo $oldData['content']; ?></textarea>
        <label id="content-error" class="error invalid-feedback" for="content"></label>
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
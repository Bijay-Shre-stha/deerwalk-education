<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_GET['mid'])) {
    $id = (int)$_GET['mid'];
    $oldData = $obj->getFieldDataById("merchandise", array("name", "image", "price"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>


<h2 class="text-center">Add Merchandise</h2>

<form action="?fold=actpages&page=act_merchandise" id="add-merchandise" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="product">Product Name :</label>
        <input type="text" class="form-control" id="product" placeholder="Enter Product name" name="product"
               value="<?php if (isset($oldData)) echo $oldData['name']; ?>">
        <label id="product-error" class="error invalid-feedback" for="product"></label>
    </div>

    <div class="form-group">
        <label for="rate">Product Rate :</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Rs. </span>
            </div>
            <input type="text" class="form-control" id="rate" placeholder="Enter Product rate" name="rate"
                   value="<?php if (isset($oldData)) echo $oldData['price']; ?>">
        </div>
        <label id="rate-error" class="error invalid-feedback" for="rate"></label>
    </div>

    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control" id="image" name="image" <?php if (!isset($oldData)) echo "required"; ?>>
        <label id="image-error" class="error invalid-feedback" for="image"></label>
        <?php if (isset($oldData)): ?>
            <p style="color: red;">*Select New Image only to change the previous image</p>
            <img src="uploads/merchandise/<?php echo $oldData['image']; ?>" alt="articles" width=100
                 style="margin-top: 15px;">
            <p style="color: green;"><u>Previous Image</u></p>
        <?php endif ?>
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
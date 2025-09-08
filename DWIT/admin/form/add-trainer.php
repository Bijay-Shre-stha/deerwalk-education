<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

if (isset($_GET['tid'])) {
    $id = (int)$_GET['tid'];
    $oldData = $obj->getFieldDataById("trainer", array("name", "signature"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>

<h2 class="text-center">Add Trainer</h2>

<form action="?fold=actpages&page=act_trainer" id="add-trainer" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Full Name :</label>
        <input type="text" class="form-control" id="name" placeholder="Enter Trainer's Full Name" name="name"
               value="<?php if (isset($oldData)) echo $oldData['name']; ?>">
        <label id="name-error" class="error invalid-feedback" for="name"></label>
    </div>

    <br>
    <div class="form-group">
        <label for="signature">Trainer Signature:</label>
        <input type="file" class="form-control" id="signature" name="signature" <?php if (!isset($oldData)) echo "required"; ?>>
        <label id="signature-error" class="error invalid-feedback" for="signature"></label>
        <?php if (isset($oldData)): ?>
            <p style="color: red;">*Select New Image only to change the previous image</p>
            <img src="uploads/trainer/<?php echo $oldData['signature']; ?>" alt="trainer_image" width=100
                 style="margin-top: 15px;">
            <p style="color: green;"><u>Previous Image</u></p>
        <?php endif ?>
    </div>
    <br>
    

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

<script type="text/javascript">
    

</script>
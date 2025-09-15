<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_GET['pid'])) {
    $id = (int)$_GET['pid'];
    $oldData = $obj->getFieldDataById("contact_person", array("name", "email", "phone"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>


<h2 class="text-center">Add Contact Person</h2>

<form action="?fold=actpages&page=act_person" id="add-person" method="POST">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"
               value="<?php if (isset($oldData)) echo $oldData['name']; ?>">
        <label id="name-error" class="error invalid-feedback" for="name"></label>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
               value="<?php if (isset($oldData)) echo $oldData['email']; ?>">
        <label id="email-error" class="error invalid-feedback" for="email"></label>
    </div>

    <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone"
               value="<?php if (isset($oldData)) echo $oldData['phone']; ?>">
        <label id="phone-error" class="error invalid-feedback" for="phone"></label>
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


<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

if (isset($_GET['hid'])) {
    $id = (int)$_GET['hid'];
    $oldData = $obj->getFieldDataById("credit_course", array("id", "code", "subject", "description"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>

<h2 class="text-center">Add DWIT Credit Course</h2>

<form action="?fold=actpages&page=act_creditCourse" id="add-creditCourse" method="POST">
    <div class="form-group">
        <label for="code">Code</label>
        <input type="text" class="form-control error" id="code" placeholder="Enter code" name="code"
               value="<?php if (isset($oldData)) echo $oldData['code']; ?>">
        <label id="code-error" class="error invalid-feedback" for="code"></label>
    </div>

    <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" class="form-control error" id="subject" placeholder="Enter subject" name="subject"
               value="<?php if (isset($oldData)) echo $oldData['subject']; ?>">
        <label id="subject-error" class="error invalid-feedback" for="subject"></label>
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control cust-editor" id="description" placeholder="Enter description here..." name="description" required
                  rows="5"><?php if (isset($oldData)) echo $oldData['description']; ?></textarea>
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
        <p style="color: red;"><b><i>Please enable JavaScript to continue</i></b></p>
    </noscript>

</form>
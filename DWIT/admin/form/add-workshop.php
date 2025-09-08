<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

$getData = $obj->select("trainer", array("id", "name"));

if (isset($_GET['wid'])) {
    $id = (int)$_GET['wid'];
    $oldData = $obj->getFieldDataById("workshop", array("name", "title", "start_date", "end_date","trainer_id"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>

<h2 class="text-center">Add Workshop</h2>

<form action="?fold=actpages&page=act_workshop" id="add-workshop" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Workshop Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter Workshop Name " name="name"
               value="<?php if (isset($oldData)) echo $oldData['name']; ?>">
        <label id="name-error" class="error invalid-feedback" for="name"></label>
    </div>

    <div class="form-group">
        <label for="title">Workshop Title:</label>
        <input type="text" class="form-control" id="title" placeholder="Enter Workshop Title" name="title"
               value="<?php if (isset($oldData)) echo $oldData['title']; ?>">
        <label id="title-error" class="error invalid-feedback" for="title"></label>
    </div>

    <div class="form-group">
        <label for="start_date">Start Date :</label>
        <input type="date" class="form-control" id="start_date" placeholder="Enter Workshop Start Date" name="start_date"
               value="<?php if (isset($oldData)) echo $oldData['start_date']; ?>">
        <label id="start_date-error" class="error invalid-feedback" for="start_date"></label>
    </div>

    <div class="form-group">
        <label for="end_date">End Date :</label>
        <input type="date" class="form-control" id="end_date" placeholder="Enter Workshop end Date" name="end_date"
               value="<?php if (isset($oldData)) echo $oldData['end_date']; ?>">
        <label id="end_date-error" class="error invalid-feedback" for="end_date"></label>
    </div>

    
    <div class="form-group">
        <label for="trainer_id">Trainer :</label>
        <select class="form-control" id="trainer_id" name="trainer_id">
            <option selected disabled>--Select trainer--</option>
            <?php
            while ($row = $getData->fetch()) {
                ?>
                <option value="<?php echo $row['id']; ?>" <?php if (isset($oldData)) {
                    if ($row['id'] == $oldData['trainer_id']) echo "selected";
                } ?> > <?php echo $row['name']; ?> </option>
            <?php } ?>
        </select>
        <label id="trainer_id-error" class="error invalid-feedback" for="trainer_id"></label>
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

<script type="text/javascript">
    

</script>
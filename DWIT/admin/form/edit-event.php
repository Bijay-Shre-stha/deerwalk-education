<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

if (isset($_GET['eid'])) {
    $id = (int)$_GET['eid'];
    $oldData = $obj->getFieldDataById("events", array("name", "start_date", "end_date"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>

<h2 class="text-center">Edit Event</h2>

<form action="?fold=actpages&page=act_calendar" id="edit-event" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name :</label>
        <input type="text" class="form-control" id="name" placeholder="Enter event name" name="name"
               value="<?php if (isset($oldData)) echo $oldData['name']; ?>">
        <label id="name-error" class="error invalid-feedback" for="name"></label>
    </div>

    <div class="form-group">
        <label for="start_date">Start Date :</label>
        <input type="date" class="form-control" id="start_date" placeholder="Enter Event Start Date" name="start_date"
               value="<?php if (isset($oldData)) echo $oldData['start_date']; ?>">
        <label id="start_date-error" class="error invalid-feedback" for="start_date"></label>
    </div>

    <div class="form-group">
        <label for="end_date">End Date :</label>
        <input type="date" class="form-control" id="end_date" placeholder="Enter Event end Date" name="end_date"
               value="<?php if (isset($oldData)) echo $oldData['end_date']; ?>">
        <label id="end_date-error" class="error invalid-feedback" for="end_date"></label>
    </div>

    <?php if (isset($oldData)) { ?><input type="hidden" name="id" value="<?php echo $id; ?>"><?php } ?>
    <input type="hidden" name="action" value="<?php echo $action; ?>">

    <button type="submit" name="formSubmitted" class="btn btn-primary">Update</button>
</form>

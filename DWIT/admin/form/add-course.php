<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

$getData = $obj->select("staff", array("id", "full_name"));

if (isset($_GET['cid'])) {
    $id = (int)$_GET['cid'];
    $oldData = $obj->getFieldDataById("courses", array("code", "sem", "stream", "subject", "description", "teacher"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>

<h2 class="text-center">Add Course</h2>

<form action="?fold=actpages&page=act_course" id="add-course" method="POST">
    <div class="form-group">
        <label for="code">Subject Code</label>
        <input type="text" class="form-control error" id="code" placeholder="Enter subject code" name="code"
               value="<?php if (isset($oldData)) echo $oldData['code']; ?>">
        <label id="code-error" class="error invalid-feedback" for="code"></label>
    </div>

    <div class="form-group">
        <label for="subject">Subject Name</label>
        <input type="text" class="form-control error" id="subject" placeholder="Enter subject name" name="subject"
               value="<?php if (isset($oldData)) echo $oldData['subject']; ?>">
        <label id="subject-error" class="error invalid-feedback" for="subject"></label>
    </div>


    <div class="form-group">
        <label for="semester">Semester:</label>
        <select class="form-control" id="semester" name="semester">
            <option selected disabled>--Select Semester--</option>
            <?php for ($i = 1; $i <= 8; $i++) { ?>
                <option value="<?php echo $i; ?>" <?php if (isset($oldData)) {
                    if ($i == $oldData['sem']) echo "selected";
                } ?> > <?php echo $i; ?> </option>
            <?php } ?>
        </select>
        <label id="semester-error" class="error invalid-feedback" for="semester"></label>
    </div>

    <div class="form-group">
        <label for="stream">Stream:</label>
        <select class="form-control" id="stream" name="stream">
            <option selected disabled>--Select Course Stream--</option>
                <option value="1" <?php if (isset($oldData)) if ($oldData['stream'] == 1) echo "selected"; ?> > BSC-CSIT </option>
                <option value="2" <?php if (isset($oldData)) if ($oldData['stream'] == 2) echo "selected"; ?> > BCA </option>
        </select>
        <label id="stream-error" class="error invalid-feedback" for="stream"></label>
    </div>


    <div class="form-group">
        <label for="content">Description:</label>
        <textarea class="form-control cust-editor" id="content" placeholder="Enter description here..." name="description" required
                  rows="5"><?php if (isset($oldData)) echo $oldData['description']; ?></textarea>
        <label id="content-error" class="error invalid-feedback" for="content"></label>
    </div>

    <div class="form-group">
        <label for="teacher">Teacher:</label>
        <select class="form-control" id="teacher" name="teacher">
            <option selected disabled>--Select Teacher--</option>
            <option value="0">N/A</option>
            <?php
            while ($row = $getData->fetch()) {
                ?>
                <option value="<?php echo $row['id']; ?>" <?php if (isset($oldData)) {
                    if ($row['id'] == $oldData['teacher']) echo "selected";
                } ?> > <?php echo $row['full_name']; ?> </option>
            <?php } ?>
        </select>
        <label id="teacher-error" class="error invalid-feedback" for="teacher"></label>
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
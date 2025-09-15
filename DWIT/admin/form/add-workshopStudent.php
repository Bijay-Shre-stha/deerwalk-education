<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

$getData = $obj->select("workshop", array("id", "name"));

if (isset($_GET['wid'])) {
    $id = (int)$_GET['wid'];
    $oldData = $obj->getFieldDataById("workshop_student", array("name","email", "workshop_id", "image_name","validation_id", "grade"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>

<h2 class="text-center">Add Workshop Students</h2>

<form action="?fold=actpages&page=act_workshopStudent" id="add-workshopStudent" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Student's Full Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter Student's Full Name" name="name"
               value="<?php if (isset($oldData)) echo $oldData['name']; ?>">
        <label id="name-error" class="error invalid-feedback" for="name"></label>
    </div>

    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" class="form-control" id="email" placeholder="Enter Student's Email Address" name="email"
               value="<?php if (isset($oldData)) echo $oldData['email']; ?>">
        <label id="email-error" class="error invalid-feedback" for="email"></label>
    </div>
    
    <br>
    <div class="form-group">
        <label for="image_name">Student's Photo:</label>
        <input type="file" class="form-control" id="image_name" name="image_name" <?php if (!isset($oldData)) echo "required"; ?>>
        <label id="image_name-error" class="error invalid-feedback" for="image_name"></label>
        <?php if (isset($oldData)): ?>
            <p style="color: red;">*Select New Image only to change the previous image</p>
            <img src="uploads/workshopStudent/<?php echo $oldData['image_name']; ?>" alt="student_image" width=100
                 style="margin-top: 15px;">
            <p style="color: green;"><u>Previous Image</u></p>
        <?php endif ?>
    </div>
    <br>


    <div class="form-group">
        <label for="workshop_id">Workshop Title:</label>
        <select class="form-control" id="workshop_id" name="workshop_id">
            <option selected disabled>--Select workshop--</option>
            <?php
            while ($row = $getData->fetch()) {
                ?>
                <option value="<?php echo $row['id']; ?>" <?php if (isset($oldData)) {
                    if ($row['id'] == $oldData['workshop_id']) echo "selected";
                } ?> > <?php echo $row['name']; ?> </option>
            <?php } ?>
        </select>
        <label id="workshop_id-error" class="error invalid-feedback" for="workshop_id"></label>
    </div>

    <div class="form-group">
        <label for="grade">Grade:</label>
        <input type="text" class="form-control" id="grade" placeholder="Enter Student's Earned Grade" name="grade"
               value="<?php if (isset($oldData)) echo $oldData['grade']; ?>">
        <label id="grade-error" class="error invalid-feedback" for="grade"></label>
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
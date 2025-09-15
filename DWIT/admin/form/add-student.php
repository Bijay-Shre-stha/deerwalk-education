<?php
$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

if (isset($_GET['sid'])) {
    $id = (int)$_GET['sid'];
    $oldData = $obj->getFieldDataById("students", array("name", "email", "school", "batch", "high_school", "district", "image"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>

<h2 class="text-center">Add Student</h2>
<form action="?fold=actpages&page=act_student" id="add-student" method="POST">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="fullname" value="<?php if (isset($oldData)) echo $oldData['name']; ?>">
        <label id="name-error" class="error invalid-feedback" for="name"></label>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php if (isset($oldData)) echo $oldData['email']; ?>">
        <label id="email-error" class="error invalid-feedback" for="email"></label>
    </div>

    <div class="form-group">
        <label for="batch">Batch:</label>
        <select class="form-control" id="batch" name="batch">
            <option selected disabled>--Select Batch--</option>
            <!-- <option value=admin>Admin</option> -->
        </select>
        <label id="batch-error" class="error invalid-feedback" for="batch"></label>
    </div>

    <div class="form-group">
        <label for="school">School:</label>
        <input type="text" class="form-control" id="school" placeholder="Enter school" name="school" value="<?php if (isset($oldData)) echo $oldData['school']; ?>">
        <label id="school-error" class="error invalid-feedback" for="school"></label>
    </div>

    <div class="form-group">
        <label for="highSchool">High Shcool:</label>
        <input type="text" class="form-control" id="highSchool" placeholder="Enter high school" name="high_school" value="<?php if (isset($oldData)) echo $oldData['high_school']; ?>">
        <label id="highSchool-error" class="error invalid-feedback" for="highSchool"></label>
    </div>

    <div class="form-group">
        <label for="district">District:</label>
        <input type="text" class="form-control" id="district" placeholder="Enter district" name="district" value="<?php if (isset($oldData)) echo $oldData['district']; ?>">
        <label id="district-error" class="error invalid-feedback" for="district"></label>
    </div>

    <div class="form-group">
        <label for="image">Image:</label>
        <input type="text" class="form-control" id="image" placeholder="Enter image url : doko" name="image" value="<?php if (isset($oldData)) echo $oldData['image']; ?>">
        <label id="image-error" class="error invalid-feedback" for="image"></label>
    </div>

    <input type="hidden" name="action" value="add">

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
    var old = <?php echo isset($oldData)? $oldData['batch'] : 'null'; ?>

    $( document ).ready(function() {
        $.ajax({
            url: "./ajax/loadOption.php",
            type: "post",
            data: {'from': 1, 'data': 'name', 'old': old},
            dataType: "json",
            success: function (response) {
                if (response.status == 1) {
                   //console.log(response.detail);
                    $('#batch').append(response.detail);
                }
            }
        });
    });
</script>
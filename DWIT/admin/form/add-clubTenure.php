<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);


if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

    $totalCount = $obj->getCount("clubs");

    if ($totalCount > 12) {
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
    
        if ($totalCount < 16)
            $perPage = 8;
        else
            $perPage = 10;
    
        $offset = ($pageno - 1) * $perPage;
    
        $totalPage = ceil($totalCount / $perPage);
    
        $getData = $obj->select("clubs", array("id", "name", "introduction", "club_mission", "club_vision"), NULL, array("id" => "DESC"), array($offset, $perPage));
    } else {
        $getData = $obj->select("clubs", array("id", "name", "introduction", "club_mission", "club_vision"), NULL, array("id" => "DESC"));
    }

    if (isset($_GET['aid'])) {
        $id = (int)$_GET['aid'];
        $oldData = $obj->getFieldDataById("clubTenure", array("president", "vice_president", "id","members", "tenure"), $id);
        $action = "edit";
    } else {
        $action = "add";
    }
?>

<?php

?>
<h2 class="text-center">Add Club Tenure</h2>
<form action="?fold=actpages&page=act_clubTenure" id="add-club" method="POST" enctype="multipart/form-data">
<div class="form-group">
    <label for="club_id">Club Name:</label>
    <select id="club_id" class="form-control" name="club_id">
    <?php
    while ($row = $getData->fetch() ) {
            ?>
            <option value="<?php echo $row['id']?>"><?php echo $row['name'];?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label for="president">President:</label>
    <input type="text" id="president" class="form-control" placeholder="Enter President full name" name="president"
    value="<?php if (isset($oldData)) echo $oldData['president']; ?>">
</div>
    <input type="hidden" name="action" value="add">
    <div class="form-group">
        <label for="vice_president">Vice President: </label>
        <input class="form-control" id="vice_president" name="vice_president" 
        value="<?php if (isset($oldData)) echo $oldData['vice_president']; ?>"
        placeholder="Enter Vice-President full name"></input>
    </div>
    <div class="form-group">
        <label for="members">Members: </label>
        <input class="form-control" id="members" name="members"
        value="<?php if (isset($oldData)) echo $oldData['members']; ?>"
        multiple placeholder="Enter Multiple members seperated by comma"></input>
    </div>
    <div class="form-group">
        <label for="tenure">Tenure: </label>
        <input class="form-control" id="tenure" name="tenure" 
        value="<?php if (isset($oldData)) echo $oldData['tenure']; ?>"
        placeholder="Eg-  2020-2021"></input>
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
</form>
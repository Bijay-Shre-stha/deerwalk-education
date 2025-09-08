<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_POST['formSubmitted'])) {
    $page = "background";
    if ($_POST['action'] == "add") {
        $obj->tbl = "background_image";

        $imageName = $obj->getFileName($_FILES['image'], "background", 0, $page);

        if ($imageName == 0) {
            Page_finder::set_message("Please select file", 'danger');
            die($obj->redirect('?page=background'));
        }

        $obj->val = array(
            "image_name" => $imageName,
            "selected" => 0
        );
        $id = $obj->insert();
        Page_finder::set_message("Data successfully Added.", 'success');
    }
}

if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $tbl = "background_image";

        $id = (int)$_GET['delete'];

        $oldData=$obj->getFieldDataById("$tbl",array("image_name"),$id);
        $obj->removeOldFile($oldData['image_name'],"background");

        $obj->tbl = $tbl;
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("Data successfully Deleted.", 'success');
    }
}

$obj->redirect('?page=background');

?>
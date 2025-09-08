<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

if (isset($_POST['formSubmitted'])) {
    $page = "merchandise";
    if ($_POST['action'] == "add") {
        $obj->tbl = "merchandise";
        $imageName = $obj->getFileName($_FILES['image'], "merchandise", 0, "merchandise");

        if ($imageName == 0) {
            Page_finder::set_message("Please select file", 'danger');
            die($obj->redirect('?page=merchandise'));
        }

        $obj->val = array(
            "name" => $obj->cleanInput($obj->checkValue($_POST['product'], $page)),
            "image" => $imageName,
            "price" => $obj->cleanInput($obj->checkValue($_POST['rate'], $page))
        );

        $id = $obj->insert();
        Page_finder::set_message("Item successfully Added.", 'success');
    }

    if ($_POST['action'] == "edit") {
        $id = $_POST['id'];
        $tbl = "merchandise";

        $imageName = $obj->getFileName($_FILES['image'], "merchandise", 0, "merchandise","mid=$id");
        $oldVersion = $obj->getFieldDataById("$tbl", array("name", "image", "price"), $id);

        if ($imageName == 0) {
            $imageName = $oldVersion['image'];
        } else {
            $obj->removeOldFile($oldVersion['image'], "merchandise");
        }

        $obj->tbl = $tbl;
        $obj->val = array(
            "name" => $obj->cleanInput($obj->checkValue($_POST['product'], $page)),
            "image" => $imageName,
            "price" => $obj->cleanInput($obj->checkValue($_POST['rate'], $page))
        );

        $obj->cond = array("id" => $id);
        $id = $obj->update();
        Page_finder::set_message("Item Edited Successfully.", 'success');
    }
}

if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $tbl = "merchandise";

        $id = (int)$_GET['delete'];

        $oldData = $obj->getFieldDataById("$tbl", array("image"), $id);
        $obj->removeOldFile($oldData['image'], "merchandise", "merchandise");

        $obj->tbl = $tbl;
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("Item successfully Deleted.", 'success');
    }
}


$obj->redirect('?page=merchandise');
?>
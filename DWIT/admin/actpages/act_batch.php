<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_POST['formSubmitted'])) {
    $page = "stsudents";
    if ($_POST['action'] == "add") {
        $obj->tbl = "batch";
        $obj->val = array(
            "name" => $obj->cleanInput($obj->checkValue($_POST['batch'], $page)),
        );
        $id = $obj->insert();
        Page_finder::set_message("Data successfully Added.", 'success');
    }

    if ($_POST['action'] == "edit") {
        $obj->tbl = "batch";
        $obj->val = array(
            "name" => $obj->cleanInput($obj->checkValue($_POST['batch'], $page)),
        );
        $obj->cond = array("id" => $_POST['id']);

        $id = $obj->update();
        Page_finder::set_message("Data Edited Successfully.", 'success');
    }
}

if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $tbl = "batch";

        $id = (int)$_GET['delete'];

        /*$oldData=$obj->getFieldDataById("$tbl",array("image_name"),$id);
        $obj->removeOldFile($oldData['image_name'],"articles");*/

        $obj->tbl = $tbl;
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("Data successfully Deleted.", 'success');
    }
}

$obj->redirect('?page=batch');

?>
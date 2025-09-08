<?php


$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_POST['formSubmitted'])) {
    $page = "healthDiploma";
    if ($_POST['action'] == "add" && isset($_POST['id'])) {
        $obj->tbl = "sub_health_diploma";
        $id = (int)$_POST['id'];
        $obj->val = array(
            "title" => $obj->cleanInput($obj->checkValue($_POST['title'], $page)),
            "priority" => $obj->cleanInput($obj->checkValue($_POST['priority'], $page)),
            "description" => $obj->checkValue($_POST['description'], $page),
            "health_diploma_id" => $id
        );
        $id = $obj->insert();
        Page_finder::set_message("Sub-Topic successfully Added.", 'success');
    }

    if ($_POST['action'] == "edit" && isset($_POST['id'])) {
        $id = (int)$_POST['id'];
        $obj->tbl = "sub_health_diploma";
        $obj->val = array(
            "title" => $obj->cleanInput($obj->checkValue($_POST['title'], $page)),
            "priority" => $obj->cleanInput($obj->checkValue($_POST['priority'], $page)),
            "description" => $obj->checkValue($_POST['description'], $page)
        );

        $obj->cond = array("id" => $id);
        $id = $obj->update();
        Page_finder::set_message("Sub-Topic Edited Successfully.", 'success');
    }
}

if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $id = (int)$_GET['delete'];

        $obj->tbl = "sub_health_diploma";
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("Sub-Topic successfully Deleted.", 'success');
    }
}


$obj->redirect('?page=healthDiploma');
?>
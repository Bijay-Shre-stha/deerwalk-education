<?php


$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_POST['formSubmitted'])) {
    $page = "healthDiploma";
    if ($_POST['action'] == "add") {
        $obj->tbl = "health_diploma";
        $obj->val = array(
            "title" => $obj->cleanInput($obj->checkValue($_POST['title'], $page)),
            "priority" => $obj->cleanInput($obj->checkValue($_POST['priority'], $page)),
            "description" => $obj->checkValue($_POST['description'], $page)
        );
        $id = $obj->insert();
        Page_finder::set_message("Data successfully Added.", 'success');
    }


    if ($_POST['action'] == "edit") {
        $id = (int)$_POST['id'];
        $obj->tbl = "health_diploma";
        $obj->val = array(
            "title" => $obj->cleanInput($obj->checkValue($_POST['title'], $page)),
            "priority" => $obj->cleanInput($obj->checkValue($_POST['priority'], $page)),
            "description" => $obj->checkValue($_POST['description'], $page)
        );

        $obj->cond = array("id" => $id);
        $id = $obj->update();
        Page_finder::set_message("Data Edited Successfully.", 'success');
    }
}

if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $id = (int)$_GET['delete'];

        $obj->tbl = "health_diploma";
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("Data successfully Deleted.", 'success');
    }
}


$obj->redirect('?page=healthDiploma');
?>
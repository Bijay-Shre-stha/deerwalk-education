<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_POST['formSubmitted'])) {
    $page = "course";
    if ($_POST['action'] == "add") {
        $obj->tbl = "courses";

        $obj->val = array(
            "code" => $obj->cleanInput($obj->checkValue($_POST['code'], $page)),
            "subject" => $obj->cleanInput($obj->checkValue($_POST['subject'], $page)),
            "sem" => $obj->cleanInput($obj->checkValue($_POST['semester'], $page)),
            "stream" => $obj->cleanInput($obj->checkValue($_POST['stream'], $page)),
            "description" => $obj->checkValue($_POST['description'], $page),
            "teacher" => $obj->cleanInput($obj->checkValue($_POST['teacher'], $page)),
            "version" => 0
        );
        $id = $obj->insert();
        Page_finder::set_message("Data successfully Added.", 'success');
    }


    if ($_POST['action'] == "edit") {
        $id = $_POST['id'];
        $tbl = "courses";

        $oldVersion = $obj->getFieldDataById("$tbl", array("version"), $id);

        $obj->tbl = $tbl;
        $obj->val = array(
            "version" => $oldVersion['version'] + 1,
            "code" => $obj->cleanInput($obj->checkValue($_POST['code'], $page)),
            "subject" => $obj->cleanInput($obj->checkValue($_POST['subject'], $page)),
            "sem" => $obj->cleanInput($obj->checkValue($_POST['semester'], $page)),
            "stream" => $obj->cleanInput($obj->checkValue($_POST['stream'], $page)),
            "description" => $obj->checkValue($_POST['description'], $page),
            "teacher" => $obj->cleanInput($obj->checkValue($_POST['teacher'], $page))
        );

        $obj->cond = array("id" => $id);
        $id = $obj->update();
        Page_finder::set_message("Data Edited Successfully.", 'success');
    }
}

if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $id = (int)$_GET['delete'];

        $obj->tbl = "courses";
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("Data successfully Deleted.", 'success');
    }
}


$obj->redirect('?page=course');
?>
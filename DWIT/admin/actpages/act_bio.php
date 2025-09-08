<?php
$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

if (isset($_POST['formSubmitted'])) {
    $page = "bio";

    if ($_POST['action'] == "add") {
        $obj->tbl = "memberBio";

        $obj->val = array(
            "name" => $_POST['name'],
            "bio" => $obj->cleanInput($obj->checkValue($_POST['bio'], $page))
        );

        $id = $obj->insert();
        Page_finder::set_message("Bio successfully Added.", 'success');
    }
    if ($_POST['action'] == "edit") {
        $id = (int)$_POST['id'];

        $obj->tbl = "memberBio";

        $obj->val = array(
            "name" => $_POST['name'],
            "bio" => $obj->cleanInput($obj->checkValue($_POST['bio'], $page))
        );

        $obj->cond = array("id" => $id);
        $id = $obj->update();
        Page_finder::set_message("Bio Edited Successfully.", 'success');
    }
}
if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $tbl = "memberBio";

        $id = (int)$_GET['delete'];

        $obj->tbl = $tbl;
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("Bio successfully Deleted.", 'success');
    }
}

$obj->redirect('?page=memberBio');
?>
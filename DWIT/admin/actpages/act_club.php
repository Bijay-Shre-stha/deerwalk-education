<?php
$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

if (isset($_POST['formSubmitted'])) {
    $page = "club";

    if ($_POST['action'] == "add") {
        $obj->tbl = "clubs";

        $obj->val = array(
            "name" => $_POST['club-name'],
            "introduction" => $obj->cleanInput($obj->checkValue($_POST['introduction'], $page)),
            "club_vision" => $obj->cleanInput($obj->checkValue($_POST['club-vision'], $page)),
            "club_mission" => $obj->cleanInput($obj->checkValue($_POST['club-mission'], $page))
        );

        $id = $obj->insert();
        Page_finder::set_message("Club successfully Added.", 'success');
    }
    if ($_POST['action'] == "edit") {
        $id = (int)$_POST['id'];

        $obj->tbl = "clubs";

        $obj->val = array(
            "name" => $_POST['club-name'],
            "introduction" => $obj->cleanInput($obj->checkValue($_POST['introduction'], $page)),
            "club_vision" => $obj->cleanInput($obj->checkValue($_POST['club-vision'], $page)),
            "club_mission" => $obj->cleanInput($obj->checkValue($_POST['club-mission'], $page))
        );

        $obj->cond = array("id" => $id);
        $id = $obj->update();
        Page_finder::set_message("Article Edited Successfully.", 'success');
    }
}
if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $tbl = "clubs";

        $id = (int)$_GET['delete'];

        $obj->tbl = $tbl;
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("Article successfully Deleted.", 'success');
    }
}

$obj->redirect('?page=club');
?>
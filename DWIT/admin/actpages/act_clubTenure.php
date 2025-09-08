<?php
$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

if (isset($_POST['formSubmitted'])) {
    $page = "clubTenure";

    if ($_POST['action'] == "add") {
        $obj->tbl = "clubTenure";
        $obj->val = array(
            "club_id" => $_POST['club_id'],
            "president" => $_POST['president'],
            "vice_president" => $_POST["vice_president"],   
            "members" => $_POST["members"],
            "tenure" => $_POST["tenure"]
        );

        $id = $obj->insert();
        Page_finder::set_message("ClubTenure successfully Added.", 'success');
    }
    if ($_POST['action'] == "edit") {
        $id = (int)$_POST['id'];

        $obj->tbl = "clubTenure";

        $obj->val = array(
            "club_id" => $_POST['club_id'],
            "president" => $_POST['president'],
            "vice_president" => $_POST["vice_president"],   
            "members" => $_POST["members"],
            "tenure" => $_POST["tenure"]
        );

        $obj->cond = array("id" => $id);
        $id = $obj->update();
        Page_finder::set_message("Article Edited Successfully.", 'success');
    }
}

if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $tbl = "clubTenure";

        $id = (int)$_GET['delete'];

        $obj->tbl = $tbl;
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("Article successfully Deleted.", 'success');
    }
}

$obj->redirect('?page=clubTenure');
?>
<?php
$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_POST['formSubmitted'])) {
    $page = "cutomize";

    if (isset($_POST['id'])) {
        $id = (int)$_POST['id'];
        $tbl = "admission_detail";

        $obj->tbl = $tbl;
        $obj->val = array(
            "csit" => $obj->cleanInput($_POST['csit']),
            "bca" => $obj->cleanInput($_POST['bca']),
            "common" => $obj->cleanInput($_POST['common'])
        );

        $obj->cond = array("id" => $id);
        $id = $obj->update();
        Page_finder::set_message("Details Edited Successfully.", 'success');
    }
}

$obj->redirect('?page=customize');

?>
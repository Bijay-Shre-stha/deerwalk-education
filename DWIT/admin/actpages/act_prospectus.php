<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_POST['formSubmitted'])) {
    $page = "prospectus";

    if ($_POST['action'] == "add") {
        $obj->tbl = "prospectus";
        $fileName = $obj->getFileName($_FILES['file'], "prospectus", 1, "prospectus", NULL, 5000000); //5MB

        if ($fileName == 0) {
            Page_finder::set_message("Please select file", 'danger');
            die($obj->redirect('?page=prospectus'));
        }

        $obj->val = array(
            "path" => $fileName,
            "name" => $obj->cleanInput($obj->checkValue($_POST['name'], $page)),
            "year" => $obj->cleanInput($obj->checkValue($_POST['year'], $page))
        );

        $id = $obj->insert();
        Page_finder::set_message("File successfully Added.", 'success');
    }
}


if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $tbl = "prospectus";

        $id = (int)$_GET['delete'];

        $oldData = $obj->getFieldDataById("$tbl", array("path"), $id);
        $obj->removeOldFile($oldData['path'], "prospectus");

        $obj->tbl = $tbl;
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("File successfully Deleted.", 'success');
    }
}


$obj->redirect('?page=prospectus');

?>
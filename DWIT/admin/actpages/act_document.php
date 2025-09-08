<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_POST['formSubmitted'])) {
    $page = "documents";

    if ($_POST['action'] == "add") {
        $obj->tbl = "pdfdocument";
        $fileName = $obj->getFileName($_FILES['file'], "pdf", 1, "document", NULL, 2000000); //2MB

        if ($fileName == 0) {
            Page_finder::set_message("Please select file", 'danger');
            die($obj->redirect('?page=documents'));
        }

        $obj->val = array(
            "version" => 0,
            "pdfurl" => $fileName,
            "title" => $obj->cleanInput($obj->checkValue($_POST['docTitle'], $page)),
            "category" => $obj->cleanInput($obj->checkValue($_POST['docCategory'], $page))
        );

        $id = $obj->insert();
        Page_finder::set_message("File successfully Added.", 'success');
    }

    if ($_POST['action'] == "edit") {
        $id = (int)$_POST['id'];
        $tbl = "pdfdocument";

        $fileName = $obj->getFileName($_FILES['file'], "pdf", 1, "document", "did=$id", 2000000); //2MB
        $oldVersion = $obj->getFieldDataById("$tbl", array("version", "pdfurl"), $id);

        if ($fileName == 0) {
            $fileName = $oldVersion['pdfurl'];
        } else {
            $obj->removeOldFile($oldVersion['image_name'], "pdfdocument");
        }

        $obj->tbl = $tbl;
        $obj->val = array(
            "version" => $oldVersion['version'] + 1,
            "pdfurl" => $fileName,
            "title" => $obj->cleanInput($obj->checkValue($_POST['docTitle'], $page)),
            "category" => $obj->cleanInput($obj->checkValue($_POST['docCategory'], $page))
        );

        $obj->cond = array("id" => $id);
        $id = $obj->update();
        Page_finder::set_message("File Edited Successfully.", 'success');
    }


}


if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $tbl = "pdfdocument";

        $id = (int)$_GET['delete'];

        $oldData = $obj->getFieldDataById("$tbl", array("pdfurl"), $id);
        $obj->removeOldFile($oldData['pdfurl'], "pdf");

        $obj->tbl = $tbl;
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("File successfully Deleted.", 'success');
    }
}


$obj->redirect('?page=documents');

?>
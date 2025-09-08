<?php
$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_POST['formSubmitted'])) {
    $page = "articles";

    if ($_POST['action'] == "add") {
        $obj->tbl = "article_post";
        $imageName = $obj->getFileName($_FILES['image'], "articles", 0, "article");

        if ($imageName == 0) {
            Page_finder::set_message("Please select file", 'danger');
            die($obj->redirect('?page=articles'));
        }

        $obj->val = array(
            "version" => 0,
            "content" => $obj->cleanInput($obj->checkValue($_POST['content'], $page)),
            "date" => date("Y-m-d H:i:s"),
            "title" => $obj->cleanInput($obj->checkValue($_POST['title'], $page)),
            "image_name" => $imageName
        );

        $id = $obj->insert();
        Page_finder::set_message("Article successfully Added.", 'success');
    }

    if ($_POST['action'] == "edit") {
        $id = (int)$_POST['id'];
        $tbl = "article_post";

        $imageName = $obj->getFileName($_FILES['image'], "articles", 0, "article","aid=$id");
        $oldVersion = $obj->getFieldDataById("$tbl", array("version", "image_name"), $id);

        if ($imageName == 0) {
            $imageName = $oldVersion['image_name'];
        } else {
            $obj->removeOldFile($oldVersion['image_name'], "articles");
        }

        $obj->tbl = $tbl;
        $obj->val = array(
            "version" => $oldVersion['version'] + 1,
            "content" => $obj->cleanInput($obj->checkValue($_POST['content'], $page)),
            "title" => $obj->cleanInput($obj->checkValue($_POST['title'], $page)),
            "image_name" => $imageName
        );

        $obj->cond = array("id" => $id);
        $id = $obj->update();
        Page_finder::set_message("Article Edited Successfully.", 'success');
    }
}

if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $tbl = "article_post";

        $id = (int)$_GET['delete'];

        $oldData = $obj->getFieldDataById("$tbl", array("image_name"), $id);
        $obj->removeOldFile($oldData['image_name'], "articles");

        $obj->tbl = $tbl;
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("Article successfully Deleted.", 'success');
    }
}

$obj->redirect('?page=articles');

?>
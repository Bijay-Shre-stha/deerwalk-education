<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_POST['formSubmitted'])) {
    $page = "trainer";
    if ($_POST['action'] == "add") {
        $obj->tbl = "trainer";
        $imageName = $obj->getFileName($_FILES['signature'], "trainer", 2, "trainer");

        if ($imageName == 0) {
            Page_finder::set_message("Please select file", 'danger');
            die($obj->redirect('?page=trainer'));
        }

        $obj->val = array(
            "name" => $obj->cleanInput($obj->checkValue($_POST['name'], $page)),
            "signature" => $imageName,
            "version" => 0
        );

        $id = $obj->insert();
        Page_finder::set_message("Data successfully Added.", 'success');
    }


    if ($_POST['action'] == "edit") {
        $id = $_POST['id'];
        $tbl = "trainer";

        $imageName = $obj->getFileName($_FILES['signature'], "trainer", "0", "trainer","tid=$id");
        $oldVersion = $obj->getFieldDataById("$tbl", array("version", "signature"), $id);

        if ($imageName == 0) {
            $imageName = $oldVersion['signature'];
        } else {
            $obj->removeOldFile($oldVersion['signature'], "trainer");
        }

        $obj->tbl = $tbl;
        $obj->val = array(
            "version" => $oldVersion['version'] + 1,
            "name" => $obj->cleanInput($obj->checkValue($_POST['name'], $page)),
            "signature" => $imageName
        );

        $obj->cond = array("id" => $id);
        $id = $obj->update();
        Page_finder::set_message("Data successfully Updated.", 'success');
       
    }
}

if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {

        $tbl = "trainer";
        $id = (int)$_GET['delete'];

        $relDataCount = $obj->getCount("workshop", array("trainer_id"=>$id));
        
        if($relDataCount>0)
        {    
            Page_finder::set_message("Trainer in Use. Try removing Trainer from Workshop assigned and TRY AGAIN or Contact System Administrator!", 'danger');
            die($obj->redirect('?page=trainer'));
        }

        $oldData = $obj->getFieldDataById("$tbl", array("signature"), $id);
        $obj->removeOldFile($oldData['signature'], "trainer");

        $obj->tbl = $tbl;
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("Data successfully Deleted.", 'success');
    }
}


$obj->redirect('?page=trainer');
?>
<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_POST['formSubmitted'])) {

    $page = "department";

    if ($_POST['action'] == "add") {
        $obj->tbl = "department";
        $obj->val = array(
            "version" => 0,
            "description" => $obj->cleanInput($obj->checkValue($_POST['description'], $page)),
            "name" => $obj->cleanInput($obj->checkValue($_POST['departmentName'], $page))
        );
        $id = $obj->insert();
        Page_finder::set_message("Department successfully Added.", 'success');
    }

    if ($_POST['action'] == "edit") {
        $obj->tbl = "department";
        $obj->val = array(
            "version" => 0,
            "description" => $obj->cleanInput($obj->checkValue($_POST['description'], $page)),
            "name" => $obj->cleanInput($obj->checkValue($_POST['departmentName'], $page))
        );

        $obj->cond = array("id" => $_POST['id']);

        $id = $obj->update();
        Page_finder::set_message("Department Edited Successfully.", 'success');
    }
}

if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $tbl = "department";

        $id = (int)$_GET['delete'];


        $otrData = $obj->select("staff", array("department_id"));
        $i = 0;
        while ($Data = $otrData->fetch()) {
            $key[$i] = $Data['department_id'];
            $i++;
        }

        if (in_array($id, $key)) {
            Page_finder::set_message("Department in Use. Try removing or changing department of existing faulty and TRY AGAIN or Contact System Administrator!", 'danger');
            die($obj->redirect('?page=department'));
        }


        // $oldData=$obj->getFieldDataById("$tbl",array("image_name"),$id);
        // $obj->removeOldFile($oldData['image_name'],"articles");

        $obj->tbl = $tbl;
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("Data successfully Deleted.", 'success');
    }
}

$obj->redirect('?page=department');
//$obj->alert($msg,$url);
?>
<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_POST['formSubmitted'])) {
    $page = "stsudents";
    if ($_POST['action'] == "add") {
        $obj->tbl = "students";
        $obj->val = array(
            "name" => $obj->cleanInput($obj->checkValue($_POST['fullname'], $page)),
            "email" => $obj->cleanInput($obj->checkValue($_POST['email'], $page)),
            "batch" => $obj->cleanInput($obj->checkValue($_POST['batch'], $page)),
            "school" => $obj->cleanInput($obj->checkValue($_POST['school'], $page)),
            "high_school" => $obj->cleanInput($obj->checkValue($_POST['high_school'], $page)),
            "district" => $obj->cleanInput($obj->checkValue(ucfirst(strtolower($_POST['district'])), $page)),
            "image" => $obj->cleanInput($obj->checkValue($_POST['image'], $page))
        );
        $id = $obj->insert();
        Page_finder::set_message("Data successfully Added.", 'success');
    }

    if ($_POST['action'] == "edit") {
        $obj->tbl = "students";
        $obj->val = array(
            "name" => $obj->cleanInput($obj->checkValue($_POST['fullname'], $page)),
            "email" => $obj->cleanInput($obj->checkValue($_POST['email'], $page)),
            "batch" => $obj->cleanInput($obj->checkValue($_POST['batch'], $page)),
            "school" => $obj->cleanInput($obj->checkValue($_POST['school'], $page)),
            "high_school" => $obj->cleanInput($obj->checkValue($_POST['high_school'], $page)),
            "district" => $obj->cleanInput($obj->checkValue(ucfirst(strtolower($_POST['district'])), $page)),
            "image" => $obj->cleanInput($obj->checkValue($_POST['image'], $page))
        );
        $obj->cond = array("id" => $_POST['id']);

        $id = $obj->update();
        Page_finder::set_message("Data Edited Successfully.", 'success');
    }
}

if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $tbl = "students";

        $id = (int)$_GET['delete'];

        /*$oldData=$obj->getFieldDataById("$tbl",array("image_name"),$id);
        $obj->removeOldFile($oldData['image_name'],"articles");*/

        $obj->tbl = $tbl;
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("Data successfully Deleted.", 'success');
    }
}

if(isset($_POST['uploadCsv']))
{
    if($_POST['uploadCsv'] == "true")
    {
        if(is_uploaded_file($_POST['studentlist']['tmp_name']))
        {
            $filename = $_POST['studentlist']['name'];
            $initType = explode("/", $__POST['studentlist']['type']);
            $type = end($initType);
            $size = $_POST['studentlist']['size'];

            if(strtolower($type) == 'csv')
            {
                if ($size < 500000) {      //fix size needed
                    $source = $_POST['studentlist']['tmp_name'];
                    $fileName = date("Ymdhis_") . $fileName;
                    $destination = "../admin/uploads/csv/" . $fileName;
                    $uploadStatus = move_uploaded_file($source, $destination);
                    if($uploadStatus == 1)
                    {
                        $uploadFrom = $destination;
                        $obj->csvReader($uploadFrom, 'students');
                    }
                    else{
                        Page_finder::set_message("CSV could not be uploaded.Please Try Again Later", 'warning');
                    }
                } else {
                    Page_finder::set_message("Upload CSV size exceed max allocated size", 'danger');
                }
            }
        }
        $msg = $obj->csvReader();
    }
}

$obj->redirect('?page=students');

?>
<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_POST['formSubmitted'])) {
    $page = "faculty";
    if ($_POST['action'] == "add") {
        $obj->tbl = "staff";
        $imageName = $obj->getFileName($_FILES['photo'], "staff", 0, "faculty");

        if ($imageName == 0) {
            Page_finder::set_message("Please select file", 'danger');
            die($obj->redirect('?page=faculty'));
        }

        $experties = $obj->dynamicContentFetch($_POST['experties']);
        $education = $obj->dynamicContentFetch($_POST['education'], $_POST['eduDate'], $page);
        $experience = $obj->dynamicContentFetch($_POST['experience'], $_POST['expDate'], $page);

        $obj->val = array(
            "version" => 0,
            "priority" => (int)$obj->cleanInput($obj->checkValue($_POST['priority'], $page)),
            "department_id" => $obj->cleanInput($obj->checkValue($_POST['department'], $page)),
            "full_name" => $obj->cleanInput($obj->checkValue($_POST['name'], $page)),
            "email" => $obj->cleanInput($obj->checkValue($_POST['email'], $page)),
            "phone" => $obj->cleanInput($obj->checkValue($_POST['phone'], $page)),
            "linkedin_profile" => $obj->cleanInput($obj->checkValue($_POST['linkedin'], $page)),
            "type" => $obj->cleanInput($obj->checkValue($_POST['status'], $page)),
            "description" => $obj->cleanInput($obj->checkValue($_POST['description'], $page)),
            "experties" => $obj->cleanInput($experties),
            "education" => $obj->cleanInput($education),
            "experience" => $obj->cleanInput($experience),
            "image_name" => $imageName
            
        );

        $id = $obj->insert();
        Page_finder::set_message("Data successfully Added.", 'success');
    }


    if ($_POST['action'] == "edit") {
        $id = $_POST['id'];
        $tbl = "staff";

        $imageName = $obj->getFileName($_FILES['photo'], "staff", 0, "faculty","fid=$id");
        $oldVersion = $obj->getFieldDataById("$tbl", array("version", "image_name"), $id);

        if ($imageName == 0) {
            $imageName = $oldVersion['image_name'];
        } else {
            $obj->removeOldFile($oldVersion['image_name'], "staff");
        }

        $experties = $obj->dynamicContentFetch($_POST['experties']);
        $education = $obj->dynamicContentFetch($_POST['education'], $_POST['eduDate'], $page);
        $experience = $obj->dynamicContentFetch($_POST['experience'], $_POST['expDate'], $page);


        $obj->tbl = $tbl;
        $obj->val = array(
            "version" => $oldVersion['version'] + 1,
            "priority" => (int)$obj->cleanInput($obj->checkValue($_POST['priority'], $page)),
            "department_id" => $obj->cleanInput($obj->checkValue($_POST['department'], $page)),
            "full_name" => $obj->cleanInput($obj->checkValue($_POST['name'], $page)),
            "linkedin_profile" => $obj->cleanInput($obj->checkValue($_POST['linkedin'], $page)),
            "email" => $obj->cleanInput($obj->checkValue($_POST['email'], $page)),
            "phone" => $obj->cleanInput($obj->checkValue($_POST['phone'], $page)),
            "type" => $obj->cleanInput($obj->checkValue($_POST['status'], $page)),
            "description" => $obj->cleanInput($obj->checkValue($_POST['description'], $page)),
            "experties" => $obj->cleanInput($experties),
            "education" => $obj->cleanInput($education),
            "experience" => $obj->cleanInput($experience),
            "image_name" => $imageName
        );

        $obj->cond = array("id" => $id);
        $id = $obj->update();
        Page_finder::set_message("Data Edited Successfully.", 'success');
    }
}

if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $tbl = "staff";

        $id = (int)$_GET['delete'];

        $relDataCount = $obj->getCount("courses", array("teacher"=>$id));
        if($relDataCount>0)
        {    
            Page_finder::set_message("Faculty in Use. Try removing faculty from course assigned and TRY AGAIN or Contact System Administrator!", 'danger');
            die($obj->redirect('?page=faculty'));
        }

        $oldData = $obj->getFieldDataById("$tbl", array("image_name"), $id);
        $obj->removeOldFile($oldData['image_name'], "staff");

        $obj->tbl = $tbl;
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("Data successfully Deleted.", 'success');
    }
}


$obj->redirect('?page=faculty');
?>
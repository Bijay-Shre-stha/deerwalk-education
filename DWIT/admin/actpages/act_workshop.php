<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_POST['formSubmitted'])) {
    $page = "workshop";
    if ($_POST['action'] == "add") {
        $obj->tbl = "workshop";
        $name =  $obj->cleanInput($obj->checkValue($_POST['name'], $page));

        $storedData = $obj->select("workshop", array("name"))->fetchAll(PDO::FETCH_COLUMN, 0);
        if (in_array($name, $storedData)) {
            Page_finder::set_message("Workshop Name already exist. Please choose unique workshop name. If need be please contact system administrator for further detail.", 'danger');
            die($obj->redirect("?page=workshop"));
        }

        $obj->val = array(
            "name" => $name,
            "title" => $obj->cleanInput($obj->checkValue($_POST['title'], $page)),
            "trainer_id" => $obj->cleanInput($obj->checkValue($_POST['trainer_id'], $page)),
            "start_date" => $obj->cleanInput($obj->checkValue($_POST['start_date'], $page)),
            "end_date" => $obj->cleanInput($obj->checkValue($_POST['end_date'], $page)),
        );

        $id = $obj->insert();
        Page_finder::set_message("Data successfully Added.", 'success');
    }


    if ($_POST['action'] == "edit") {
        $id = $_POST['id'];
        $obj->tbl = "workshop";
    
        $obj->val = array(
            "name" => $obj->cleanInput($obj->checkValue($_POST['name'], $page)),
            "title" => $obj->cleanInput($obj->checkValue($_POST['title'], $page)),
            "trainer_id" => $obj->cleanInput($obj->checkValue($_POST['trainer_id'], $page)),
            "start_date" => $obj->cleanInput($obj->checkValue($_POST['start_date'], $page)),
            "end_date" => $obj->cleanInput($obj->checkValue($_POST['end_date'], $page)),
        );

        $obj->cond = array("id" => $id);
        $id = $obj->update();
        Page_finder::set_message("Data Edited Successfully.", 'success');
    }
}

if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $id = (int)$_GET['delete'];
        $obj->tbl = "workshop";
        $obj->cond = array("id" => $id);

        $relDataCount = $obj->getCount("workshop_student", array("workshop_id"=>$id));
        
        if($relDataCount>0)
        {    
            Page_finder::set_message("Students are assigned to the Workshop.TRY AGAIN or Contact System Administrator!", 'danger');
            die($obj->redirect('?page=workshop'));
        }
        
        $id = $obj->delete();
        Page_finder::set_message("Data successfully Deleted.", 'success');
    }
}

function getUniqueValidationId($obj){

    //generate random 10 digit number
    $randomNumber = rand(100000000, 999999999);
    $validationId = "DWIT-".$randomNumber;
    $checkDuplicateValidationId = $obj->getCount("workshop", "validation_id='$validationId'");

    if ($checkDuplicateValidationId == 1) {
        getUniqueValidationId($obj);
    }

    return $validationId;
}

$obj->redirect('?page=workshop');
?>
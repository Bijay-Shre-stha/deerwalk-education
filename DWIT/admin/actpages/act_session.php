<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_POST['formSubmitted'])) {
    $page = "openHouse";
    $sessionYear = $obj->cleanInput($obj->checkValue($_POST['sessionYear'], $page));
    $sessionNum = $obj->cleanInput($obj->checkValue($_POST['sessionNum'], $page));

    //for session - 1
    $sessionDate1 = $obj->cleanInput($obj->checkValue($_POST['sessionDate1'], $page));
    $sessionTime1 = $obj->cleanInput($obj->checkValue($_POST['sessionTime1'], $page));
        //sessionType = 1 => online date; sessionType = 2 => on campus//
    $sessionType1 = (isset($_POST['sessionType1']) && $obj->cleanInput($_POST['sessionType1']) == 2) ? 2 : 1;
    $maxCount1 = $obj->cleanInput($obj->checkValue($_POST['maxParticipants1'], $page));


    //for session - 2 (session 2 is optional)
    if(isset($_POST['sessionDate2']) && !empty($_POST['sessionDate2']))
    {
        $sessionDate2 = $obj->cleanInput($obj->checkValue($_POST['sessionDate2'], $page));
        $sessionTime2 = $obj->cleanInput($obj->checkValue($_POST['sessionTime2'], $page));
        //sessionType = 1 => online date; sessionType = 2 => on campus//
        $sessionType2 = (isset($_POST['sessionType2']) && $obj->cleanInput($_POST['sessionType2']) == 2) ? 2 : 1;
        $maxCount2 = $obj->cleanInput($obj->checkValue($_POST['maxParticipants2'], $page));                   
    }else{
        $sessionDate2 = NULL;
        $sessionTime2 = NULL;
        $sessionType2 = NULL;
        $maxCount2 = NULL;
    }

    if ($_POST['action'] == "add") {
        $obj->tbl = "open_house";
        
        $totalCount = $obj->getCount("open_house", array('session_year' => $sessionYear, 'session_num' => $sessionNum));
        if($totalCount > 0)
        {
            Page_finder::set_message("Open House Session Alredy Exists", 'warning');
            die($obj->redirect('?page=add-session&fold=form'));
        }

        $obj->val = array(
            "version" => 0,
            "session_year" => $sessionYear,
            "session_num" => $sessionNum,
            // session - 1
            "session_date_1" => $sessionDate1,
            "session_time_1" => $sessionTime1,
            "session_type_1" => $sessionType1,
            "max_count_1" => $maxCount1,
            // session - 2
            "session_date_2" => $sessionDate2,
            "session_time_2" => $sessionTime2,
            "session_type_2" => $sessionType2,
            "max_count_2" => $maxCount2,
            // common
            "enable" => 1,
            "email_of_admin" => $_SESSION['email']
        );

        $id = $obj->insert();
        Page_finder::set_message("Data successfully Added.", 'success');
    }

    if ($_POST['action'] == "edit") {

        $id = $_POST['id'];
        $tbl = "open_house";

        $totalCount = $obj->getCount("open_house", "session_year = $sessionYear AND session_num = $sessionNum AND id <> $id");
        if($totalCount > 0)
        {
            Page_finder::set_message("Open House Session Alredy Exists", 'warning');
            die($obj->redirect("?page=add-session&fold=form&sid=$id"));
        }

        $oldVersion = $obj->getFieldDataById("$tbl", array("version"), $id);
        $newVersion = $oldVersion['version'] + 1;
        $obj->tbl = $tbl;

        $obj->val = array(
            "version" => $newVersion,
            "session_year" => $sessionYear,
            "session_num" => $sessionNum,
            // session - 1
            "session_date_1" => $sessionDate1,
            "session_time_1" => $sessionTime1,
            "session_type_1" => $sessionType1,
            "max_count_1" => $maxCount1,
            // session - 2
            "session_date_2" => $sessionDate2,
            "session_time_2" => $sessionTime2,
            "session_type_2" => $sessionType2,
            "max_count_2" => $maxCount2,
            // common
            "enable" => 1,
            "email_of_admin" => $_SESSION['email']
        );
        $obj->cond = array("id" => $id);
        $id = $obj->update();
        Page_finder::set_message("Data Edited Successfully.", 'success');
    }
}
$obj->redirect('?page=openHouse');

?>
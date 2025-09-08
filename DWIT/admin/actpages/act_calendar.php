<?php
include("includes/connection.php");

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

require_once('../system/application_top.php');

if (isset($_POST['formSubmitted'])) {
    // die("up");
    $page = "calendar";
    
    if ($_POST['action'] == "add") {
        $obj->tbl = "events";
        $icsEvents = $obj->getIcsEventsAsArray($_FILES['ics-file']['tmp_name']);
        
        foreach ( $icsEvents as $icsEvent){
            $start = isset( $icsEvent ['DTSTART;VALUE=DATE'] ) ? $icsEvent ['DTSTART;VALUE=DATE'] : $icsEvent ['DTSTART'];
            $startDate = date( 'Y-m-d',strtotime($start) );
            
            /* Getting end date with time */
            $end = isset( $icsEvent ['DTEND;VALUE=DATE'] ) ? $icsEvent ['DTEND;VALUE=DATE'] : $icsEvent ['DTEND'];
            $endDate = date( 'Y-m-d',strtotime($end) );
            
            $eventNames = $icsEvent['SUMMARY'];
            
            $obj->val = array(
                    'name' => $eventNames,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                );
            $id = $obj->insertOrUpdate();

            Page_finder::set_message("Data successfully Added.", 'success');

        }
    }

    if ($_POST['action'] == "edit") {
        $id = $_POST['id'];
        $tbl = "events";
        $obj->tbl = $tbl;
        
        $page="events";
        $obj->val = array(
            "name" => $obj->cleanInput($obj->checkValue($_POST['name'], $page)),
            "start_date" => $obj->cleanInput($obj->checkValue($_POST['start_date'], $page)),
            "end_date" => $obj->cleanInput($obj->checkValue($_POST['end_date'], $page)),
        );
        
        $obj->cond = array("id" => $id);
        $id = $obj->update();
        Page_finder::set_message("Data Edited Successfully.", 'success');
    }
}


if (isset($_GET['delete'])) {
    // die("here");
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $tbl = "events";

        $id = (int)$_GET['delete'];

        $obj->tbl = $tbl;
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("Data successfully Deleted.", 'success');
    }
}

$obj->redirect('?page=events');

?>
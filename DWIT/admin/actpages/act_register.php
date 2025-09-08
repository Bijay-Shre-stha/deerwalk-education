<?php
 ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {

        $id = (int)$_GET['delete'];

        $sourceTbl = "preRegisterSource";
        
        $sourceCond = array("register_id" => $id);
    
        $obj->tbl = $sourceTbl;
        $obj->cond = $sourceCond;
        $obj->delete();

        $tbl = "preRegister";

        $obj->tbl = $tbl;
        $obj->cond = array("id" => $id);
        $id = $obj->delete();
        Page_finder::set_message("Registration deleted successfully Deleted.", 'success');
    }
}

die($obj->redirect('?page=preRegister'));
?>
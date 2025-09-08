<?php
$auth = $_SESSION['authid'];

if (!$user->is_loggedin()) {
    $obj->redirect('login.php');
}

?>
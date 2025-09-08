<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

require_once('../system/application_top.php');

if (isset($_POST['formSubmitted'])) {
    $page = "users";
    if ($_POST['action'] == "add") {
        $obj->tbl = "user";
        $email = $obj->StringInputCleaner($obj->checkValue($_POST['email'], $page));
        $password = $user->hashed_password($obj->StringInputCleaner($obj->checkValue($_POST['password'], $page)));

        $storedData = $obj->select("user", array("email"))->fetchAll(PDO::FETCH_COLUMN, 0);
        if (in_array($email, $storedData)) {
            Page_finder::set_message("User already exist. Please contact system administrator for further detail.", 'danger');
            die($obj->redirect("?page=users"));
        }

        $obj->val = array(
            "version" => 0,
            "email" => $email,
            "full_name" => $_POST['fullname'],
            "password" => $password,
            "type" => $_POST['type'],
            "enable" => 1
        );
        $id = $obj->insert();
        Page_finder::set_message("User successfully Added.", 'success');
    }

    if ($_POST['action'] == "update" && isset($_POST['id'])) {
        $id = (int)$_POST['id'];
        $oldPass = $obj->StringInputCleaner($obj->checkValue($_POST['oldPass'], $page));
        $newPass = $obj->StringInputCleaner($obj->checkValue($_POST['newPass'], $page));
        $rePass = $obj->StringInputCleaner($obj->checkValue($_POST['rePass'], $page));

        $getData = $obj->select("user", array("email"), array("id" => $id));
        $row = $getData->fetch();
        $email = $row['email'];

        $status = $user->checkLogin($email, $oldPass, 1);

        if ($status == "Verified") {
            if ($newPass == $rePass) {
                $tbl = "user";
                $obj->tbl = $tbl;
                $password = $user->hashed_password($newPass);
                $oldVersion = $obj->getFieldDataById("$tbl", array("version"), $id);
                $newVersion = $oldVersion['version'] + 1;
                $obj->val = array(
                    "version" => $newVersion,
                    "password" => $password,
                );
                $obj->cond = array("id" => $id);
                $id = $obj->update();
                Page_finder::set_message("Password Updated Successfully.", 'success');
                $_SESSION['version'] = $newVersion;
            } else {
                Page_finder::set_message("Password Mismatched!!! Please try again later.", 'danger');
                die($obj->redirect("?fold=form&page=change-password"));
            }
        } else {
            Page_finder::set_message("Incorrect Password!!! Please try again later.", 'danger');
            die($obj->redirect("?fold=form&page=change-password"));
        }
    }
}
$obj->redirect('index.php?page=users');
?>
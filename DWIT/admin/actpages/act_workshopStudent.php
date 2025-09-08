<?php
// include("../system/phpmailer");
$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);
require_once('../system/phpmailer/class.phpmailer.php');

require_once("../system/phpmailer/class.smtp.php");

require_once ("../system/phpmailer/PHPMailerAutoload.php");

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// require '../vendor/autolsoad.php';

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_POST['formSubmitted'])) {
    $page = "workshopStudent";
    
    if ($_POST['action'] == "add") {
        $obj->tbl = "workshop_student";
        $imageName = $obj->getFileName($_FILES['image_name'], "workshopStudent", 0, "workshopStudent");
        $name = $obj->cleanInput($obj->checkValue($_POST['name'], $page));
        $email = $obj->cleanInput($obj->checkValue($_POST['email'], $page));
        $workshop_id = $obj->cleanInput($obj->checkValue($_POST['workshop_id'], $page));
        $grade = $obj->cleanInput($obj->checkValue($_POST['grade'], $page));

        if ($imageName == 0) {
            Page_finder::set_message("Please select file", 'danger');
            die($obj->redirect('?page=workshopStudent'));
        }

        $validation_id = getUniqueValidationId($obj);

        // die(print_r($validation_id));
        $obj->val = array(
            "name" => $name,
            "email" => $email,
            "image_name" => $imageName,
            "workshop_id" => $workshop_id,
            "validation_id" => $validation_id,
            "grade" => $grade,
            "version" => 0
        );
        
        $workshopDetail = $obj->select("workshop",array("workshop.name","workshop.title","workshop.id AS workshopId","workshop_student.workshop_id","workshop.start_date","workshop.end_date"),['workshop.id'=>$workshop_id], NULL,NULL,"LEFT","workshop_student","id","workshop_id");
        $row = $workshopDetail->fetch();
        // die(print_r($row));

        $startDate = strtotime($row['start_date']);
        $endDate = strtotime($row['end_date']);
        $days = ($endDate - $startDate)/(60*60*24);
        $days = $days + 1;

        if($days == 1)
            $day = "day";
        else
            $day = "days";
        // die(print_r($days));
        $fname = explode(" ", $name)[0];

        $id = $obj->insert();
        if($id){
            $message ='';
            $message .= "<div>";
            $message .= "<p>Hello $fname,</p>";
            $message .= "<p>Congratulations on completing ".$days." $day ".$row['title']." Workshop.";
            $message .= "You can find your certificate in deerwalk.edu.np/DWIT. Please use following verification code to access your certificate.";
            $message .= "</p>";
            $message .= "<p>Verification Code: <strong>$validation_id</strong></p>";
            $message .= "<p>Thanks,</p>";
            $message .= "<p>Digital Media Lab</p>";
            $message .= "</div>";
            
            $to = $email;
            $subject = "Verification Code";

            $result = $obj->sendMail("DMT",$to, $subject, $message, $cc = null, $bcc = null);
            $mailResult = '';
            if($result)
            {
                $mailResult = "and Mail Sent Successfully";
            }else
            {
                $mailResult = "Mail Sent Failed";
            }
        }
        
        Page_finder::set_message("Data successfully Added.$mailResult", 'success');
    }


    if ($_POST['action'] == "edit") {
        $id = $_POST['id'];
        $tbl = "workshop_student";
        $obj->tbl = "workshop_student";
        
        $imageName = $obj->getFileName($_FILES['image_name'], "workshopStudent", "0", "workshopStudent","wid=$id");
        $oldVersion = $obj->getFieldDataById("$tbl", array("version", "image_name"), $id);

        if ($imageName == 0) {
            $imageName = $oldVersion['image_name'];
        } else {
            $obj->removeOldFile($oldVersion['image_name'], "workshopStudent");
        }

        $obj->val = array(
            "name" => $obj->cleanInput($obj->checkValue($_POST['name'], $page)),
            "email" => $obj->cleanInput($obj->checkValue($_POST['email'], $page)),
            "workshop_id" => $obj->cleanInput($obj->checkValue($_POST['workshop_id'], $page)),
            "image_name" => $imageName,
            "grade" => $obj->cleanInput($obj->checkValue($_POST['grade'], $page)),
            "version" => $oldVersion['version'] + 1,
        );

        $obj->cond = array("id" => $id);
        $id = $obj->update();
        Page_finder::set_message("Data Edited Successfully.", 'success');
    }
}

if (isset($_GET['delete'])) {
    if ($_GET['action'] == "delete" && $_GET['delete'] != '') {
        $id = (int)$_GET['delete'];
        $tbl = "workshop_student";

        $obj->tbl = "workshop_student";
        $obj->cond = array("id" => $id);

        $oldData = $obj->getFieldDataById("$tbl", array("image_name"), $id);
        $obj->removeOldFile($oldData['image_name'], "workshopStudent");

        $id = $obj->delete();
        Page_finder::set_message("Data successfully Deleted.", 'success');
    }
}

function getUniqueValidationId($obj){

    //generate random 10 digit number
    $randomNumber = rand(100000000, 999999999);
    $validationId = "DWIT-".$randomNumber;
    $checkDuplicateValidationId = $obj->getCount("workshop_student", "validation_id='$validationId'");

    if ($checkDuplicateValidationId == 1) {
        getUniqueValidationId($obj);
    }

    return $validationId;
}

$obj->redirect('?page=workshopStudent');
?>
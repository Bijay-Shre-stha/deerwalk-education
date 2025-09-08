<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $myPDF = $obj->getFieldDataById("pdfdocument", array("pdfurl", "title"), $id);
}
?>

<embed height="90%" width="100%" src="<?php echo "uploads/pdf/" . $myPDF['pdfurl']; ?>"></embed>


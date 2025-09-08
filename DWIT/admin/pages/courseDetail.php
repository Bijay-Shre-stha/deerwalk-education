<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


if (!isset($_GET['id'])) {
    header("location:index.php");
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $data = $obj->selectDataByField("courses", array("code", "subject", "description", "sem"), "id=$id");
}

?>

    <h2 class="text-center">Semester-<?php echo $obj->numToRoman($data['sem']); ?></h2>

    <p><label><b><?php echo $data['code'] . "-" . $data['subject']; ?></b></label></p>

<?php echo $data['description']; ?>
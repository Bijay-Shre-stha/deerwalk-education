<?php

if (isset($_POST['id'])) {
    include '../../system/application_top.php';

    $table = $obj->cleanInput($_POST['table']);
    $field = $obj->cleanInput($_POST['field']);
    $value = $obj->cleanInput($_POST['value']);
    $id = (int)$_POST['id'];

    if ($value == 0)
        $newValue = 1;
    else
        $newValue = 0;

    $data = $obj->db->query("update " . $table . " set " . $field . "=" . $newValue . " where id='" . $id . "' ");

    if($table == "batch")
        $obj->toggleStatus('students', 'status', $newValue, 'batch', $id);

    // echo $data;

    // echo $data->rowCount();
    // echo $id;

    if ($data->rowCount()) {
        echo json_encode(array("status" => 1));
    }
} else {
    header("location:../login.php");
}


?>
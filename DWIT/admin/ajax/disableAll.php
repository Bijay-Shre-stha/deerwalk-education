<?php 

if(isset($_POST['table']) && isset($_POST['column']) && isset($_POST['id']))
{
    include '../../system/application_top.php';

	$table = $obj->cleanInput($_POST['table']);
	$column = $obj->cleanInput($_POST['column']);
	$id = (int) $_POST['id'];

	$data = $obj->db->query("UPDATE $table SET $column = 0");
	$data = $obj->db->query("UPDATE $table SET $column = 1 WHERE id = $id");


	if($data->rowCount())
		echo json_encode(array("status" => 1));
}else {
    header("location:../login.php");
}


 ?>
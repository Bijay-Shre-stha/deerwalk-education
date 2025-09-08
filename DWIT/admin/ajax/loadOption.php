<?php include '../../system/application_top.php'; 

if(isset($_POST['from']) && isset($_POST['data']))
{
	$mapping = array(1 => 'batch');

	$from = (int)$_POST['from'];
	$field = $obj->StringInputCleaner($_POST['data']);

	$table = $mapping[$from];

	$data = $obj->selectAllDataByField($table, array('id', $field), null);

	$result = '';
	$id = (int)$_POST['old'];

	if($id != null)
	{
		foreach ($data as $v) {
			$flag = $v['id'] == $id ? 'selected' : '';
			$result .= "<option value='".$v['id']."' ".$flag.">".$v['name']."</option>";
		}
	}else{
		foreach ($data as $v) {
			$result .= "<option value='".$v['id']."'>".$v['name']."</option>";
		}
	}


}


echo json_encode(array("detail" => $result, "status" => 1));

?>
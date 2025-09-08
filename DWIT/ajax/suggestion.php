<?php 
	include('../system/application_top.php');
	
	if(isset($_POST['value']) && isset($_POST['type']))
	{
		$value = $_POST['value'];
		$value = $obj->StringInputCleaner($value);

		$type = (int)$_POST['type'];

		if($type == 1)
			$field = 'school';
		else
			$field = 'high_school';
		
		$search = $obj->db->prepare("Select distinct $field from students where $field like :value limit 5");
		$search->bindValue('value', '%'.$value.'%');
		$search->execute();

		$data = $search->fetchAll(PDO::FETCH_ASSOC);

        $suggestionList = "<ul class='suggest-box form-control'>";
			foreach ($data as $value) {
				$suggestionList .= "<li onclick='setValue(this.textContent, ".$type.")'>".$value[$field]."</li>";
			}
		$suggestionList .= "<li onclick='setValue(this.textContent, ".$type.")'>Not Available</li>";
		$suggestionList .= "</ul>";
		
		echo json_encode(array('detail' => $suggestionList, "status" => 1));
	}

	if(isset($_POST['school']) && isset($_POST['high_school']) && isset($_POST['district']))
	{
		$school = $_POST['school'];
		$high_school = $_POST['high_school'];
		$district = $_POST['district'];

		if(($school != null) && ($high_school != null) && ($district != null))
		{
			$school = $obj->StringInputCleaner($school);
			$high_school = $obj->StringInputCleaner($high_school);
			$district = $obj->StringInputCleaner($district);

			$suggestionSql = $obj->db->prepare("
			SELECT students.name, students.high_school, students.image, students.id 
			FROM students 
			LEFT JOIN batch ON students.batch = batch.id 
			WHERE batch.status = '1' AND (
				(school = :school AND high_school = :high_school AND district = :district) OR
				(school = :school AND high_school = :high_school) OR
				(school = :school) OR
				(high_school = :high_school) OR
				(district = :district AND marker = '1') OR
				(district = :district)
			)
			ORDER BY rand()
			");

			$suggestionSql->bindValue('school', $school);
			$suggestionSql->bindValue('high_school', $high_school);
			$suggestionSql->bindValue('district', $district);

			$suggestionSql->execute();

			$data = $suggestionSql->fetchAll(PDO::FETCH_ASSOC);

			$connected = [];
			if (count($data) > 0) {
				shuffle($data);
				$connected = array_slice($data, 0, 6);
			}
			echo json_encode(array("status" => 1, "detail" => $connected));

		}else{
			echo json_encode(array("status" => 2));
		}
	}

 ?>
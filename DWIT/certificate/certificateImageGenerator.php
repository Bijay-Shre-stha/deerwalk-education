<!-- Using PHP GD Library to process images and creating dynamic certificates, captcha, reports etc. -->

<?php 
$pgName = "Certificate Image Generator";
require_once("../system/application_top.php");

if (isset($_GET['validation_id'])){

  $validationId = trim($_GET['validation_id']);

  $getData = $obj->select("workshop_student", array( "workshop_student.name AS studentName", "workshop_student.workshop_id", "workshop.title AS workshopTitle", "workshop.id As workshopId", "workshop_student.validation_id", "workshop_student.grade"),  ["validation_id"=>$validationId],NULL, NULL, "LEFT", "workshop", "workshop_id", "id");
  $row = $getData->fetch();
  
  $workshopId = $row['workshopId'];

  $getTrainerData = $obj->select("trainer",array("trainer.id","trainer.name","trainer.signature","workshop.id AS workshopId"),['workshop.id'=>$workshopId], NULL,NULL,"LEFT","workshop","id","trainer_id");
  $trainerData = $getTrainerData->fetch();

  ob_end_clean();
  header('Content-type: image/jpeg');

  $jpg_image = imagecreatefromjpeg('./images/certificateTemplate.jpg');
  $signature_path = "../admin/uploads/trainer/".$trainerData['signature'];
  $signature = imagecreatefrompng($signature_path);

//this is going to be created once the generate button is clicked
  $output = "certificate.jpg";
  $studentName = $row['studentName'];
  $workshopTitle = $row['workshopTitle'];
  $grade = $row['grade'];
  
//then we make use of the imagecolorallocate inbuilt php function which i used to set color to the text we are displaying on the image in RGB format
  $white = imagecolorallocate($jpg_image, 205, 245, 255);
  $black = imagecolorallocate($jpg_image, 0, 0, 0);
  $grey = imagecolorallocate($jpg_image, 39, 39, 39);
  $font_size = 100;
  
  // Set Path to Font File
  $studentName_font_path = dirname(__FILE__)."./fonts/timesNewRoman.ttf"; //'D:/php-7.4/htdocs/Deerwalk-Education-Group/DWIT/font.ttf';
  $workshopTitle_font_path = dirname(__FILE__)."./fonts/myriadPro.ttf";
  $grade_font_path = dirname(__FILE__)."./fonts/openSansRegular.ttf"; 
  // name - times new roman 33.48pt 44.639px
  // workshop - myriad pro 25pt 33.33px
  //grade - opensans regular 13pt 17.33px
  
  //imagettftext($jpg_image, $font_size, $rotation, $origin_x, $origin_y, $black, $studentName_font_path, $name_text);
  imagettftext($jpg_image, 100, 0, 270, 900, $black, $studentName_font_path, strtoupper($studentName));
  imagettftext($jpg_image, 60, 0, 270, 1300, $black, $workshopTitle_font_path, strtoupper($workshopTitle));
  imagettftext($jpg_image, 45, 0, 1080, 1475, $black, $grade_font_path, strtoupper($grade).'.');
  imagettftext($jpg_image, 41, 0, 2423, 2290, $grey, $grade_font_path, "Student ID : ".$validationId);

  
	$width=imagesx($signature);
	$height=imagesy($signature);

  // imagecopyresampled($dst_image, $src_image,int $dst_x,int $dst_y,int $src_x, int $src_y, int $dst_width, int $dst_height,int $src_width,int $src_height)
  imagecopyresampled($jpg_image, $signature, 300, 1750, 0, 0,500,450, $width, $height);

	imagecolortransparent( $jpg_image, $white);

  // Send Image to Browser
  imagejpeg($jpg_image);

  // Clear Memory
  imagedestroy($jpg_image);
}
 ?>
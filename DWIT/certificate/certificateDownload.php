<?php
$pgName = "Certificate PDF Downloader";
require_once("../system/application_top.php");

ob_clean();
require('../resource/pdf/fpdf/fpdf.php');

$img = "certificateTemplate.jpg";
$path = dirname(__FILE__)."/images/".$img;


if (isset($_GET['validation_id'])){
    $validationId = trim($_GET['validation_id']);

    $getData = $obj->select("workshop_student", array( "workshop_student.name AS studentName", "workshop_student.workshop_id", "workshop.title AS workshopTitle", "workshop.id As workshopId", "workshop_student.validation_id", "workshop_student.grade"),  ["validation_id"=>$validationId],NULL, NULL, "LEFT", "workshop", "workshop_id", "id");
    $row = $getData->fetch();
    
    $workshopId = $row['workshopId'];

    $getTrainerData = $obj->select("trainer",array("trainer.id","trainer.name","trainer.signature","workshop.id AS workshopId"),['workshop.id'=>$workshopId], NULL,NULL,"LEFT","workshop","id","trainer_id");
    $trainerData = $getTrainerData->fetch();

    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->AddFont("myriadPro", "", "myriadPro.php");
    $pdf->AddFont("openSansRegular", "", "openSansRegular.php");

    // Trainer Signature
    $target_file = dirname(__FILE__)."/images/"."satyadeep.png";

    list($x1, $y1) = getimagesize($path);
    $x2 = 20;
    $y2 = 89;
    $pdf->Image($path,$x2,$y2,0,120);

    // name - times new roman 33.48pt 44.639px
    // workshop - myriad pro 25pt 33.33px
    //grade - opensans regular 13pt 17.33px

    $pdf->SetFont('Times','',18);
    $pdf->Text(33.5,133, strtoupper($row['studentName']));

    $pdf->SetFont('myriadPro','',16);
    $pdf->Text(33.5,152, strtoupper($row['workshopTitle']));

    $pdf->SetFont('myriadPro','',8);
    $pdf->Text(72.5,160.25, strtoupper($row['grade']).'.');

    $pdf->SetFont('Arial','',7);
    $pdf->SetTextColor(39,39,39);
    $pdf->Text(137,200, 'Student ID: '.$validationId);

    // Image(string file [, float x [, float y [, float w [, float h [, string type [, mixed link]]]]]])
    $pdf->Image($target_file, 30, 163,38,39);
   
    $download_file_name = $row['studentName'] . '_' . $validationId . '.pdf';
    $pdf->Output('D', $download_file_name);
}

?>
<?php 
include('./include/header.php');
$message=NULL;
$messageType=NULL;

if (isset($_GET['validation_id'])) {
    $validationId = trim($_GET['validation_id']);
    
    $getData = $obj->select("workshop_student", array("workshop_student.id", "workshop_student.name AS studentName",  "workshop_student.image_name", "workshop.title AS workshopTitle", "workshop.id As workshopId", "workshop_student.validation_id", "workshop_student.grade", "version","workshop.start_date", "workshop.end_date"),  ["validation_id"=>$validationId], array("workshop_student.id" => "DESC"), NULL, "LEFT", "workshop", "workshop_id", "id");
    $row = $getData->fetch();
    
    $workshopId = $row['workshopId'];
    
    $getTrainerData = $obj->select("trainer",array("trainer.id","trainer.name","trainer.signature","workshop.id AS workshopId"),['workshop.id'=>$workshopId], NULL,NULL,"LEFT","workshop","id","trainer_id");
    $trainerData = $getTrainerData->fetch();

    if ($row) {
        $student_name = $row['studentName'];
        $studentImage = $row['image_name'];
        $workshop_title = $row['workshopTitle'];
        $grade = $row['grade'];
        $startDate = $row['start_date'];
        $endDate = $row['end_date'];
        $validationID = $row['validation_id'];
        $trainer_name = $trainerData['name'];
        $trainer_signature = $trainerData['signature'];//"20220802045136_Satyadip_dai.png";
        //filename for downloading in png
        $filename=$validationID.'-'.$student_name;

    } else {
        $message = "Sorry. We cannot find any Student Record for the ID you entered. - DWIT";
        $messageType = "danger";
        echo "<div class=\"message alert alert-$messageType\"> $message
        </div>";
            $url = '../index';
        echo '<META HTTP-EQUIV=REFRESH CONTENT="1.5; ' . $url . '">';  
        exit(); 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/certificateDetails.css" rel="stylesheet">
    <title>Certificate</title>
</head>
<body>
    
    <div class="container-fluid">
        <!-- Student Details Div + Certificate Div Start -->
        <div class="row certificate-details-div">
            
            <!-- Student Details + Congratulations Div Start-->
            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 student-details-and-congratulation">
                <div class="row">
                    <!-- congratulation message Start-->
                    <div class="congratulation-message-div col-xl-12 col-md-5 col-lg-12">
                        <h4 class="congratulation-heading-text">Congratulations, <?php echo $student_name;?></h4>
                        <p class="congratulation-msg-text">You worked hard to earn your certificate from DWIT- share it with your friends, family and colleague online.</p>
                        <!-- Share Icons -->
                        <div class="sharing-icon d-flex flex-row-reverse"> 
                            <div class="p-2 fb-sharing-icon">
                                    <div id="fb-root"></div>
                                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v14.0" nonce="7d7dO5DU"></script>
                                    <div class="fb-share-button" data-href="https://deerwalk.edu.np/DWIT/certificate/certificateImageGenerator.php?validation_id=" data-layout="button" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdeerwalk.edu.np%2FDWIT%2Fcertificate%2FcertificateImageGenerator.php%3Fvalidation_id&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
                                <!-- <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdeerwalkcompware.com%2Ftraining%2FcertificateDetails%2F<?php echo $validation_id;?>&layout=button&size=small&width=67&height=20&appId" width="67" height="20" style="border:none;overflow:hidden;" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe> -->
                            </div>
                            <div class="p-2 linked-in-sharing-icon">
                                <script src="https://platform.linkedin.com/in.js" type="text/javascript">lang: en_US</script>
                                <script type="IN/Share" data-url="https://deerwalk.edu.np/DWIT/certificate/certificateImageGenerator.php?validation_id=<?php echo $validation_id;?>"></script>
                            </div>
                        </div>
                    </div>
                    <!-- Congratulation Message End -->
                    <br>

                    <!-- Student details Start-->
                    <div class="col-md-7 col-lg-12 col-xl-12">
                        <div class="row student-details-div">
                            <!-- Student PP Photo  -->
                            <div class="col-4 col-md-12 col-lg-12 col-xl-3 student-image-div">
                                <img src="./admin/uploads/workshopStudent/<?php echo $studentImage;?>" class="student-image" alt="student_pp" height="150rem" width="150rem"/>
                            </div>
                            <!-- Actual Students Detail Div Start -->
                            <div class="col-sm-0 col-8 col-md-12 col-lg-12 col-xl-8">
                                <!-- Course -->
                                <div class="row student-details-only">
                                    <div class="col-xl-6 col-lg-6 col-md-7 col-sm-6 col-6 detail">
                                        <p class="student-name-text font-weight-bold">Course :</p>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-5 col-sm-6 col-6 detail">
                                        <p class="student-name-text detail-text"> <?php echo $workshop_title;?></p>
                                    </div>    
                                </div>
                                <!-- Started On -->
                                <div class="row student-details-only">
                                    <div class="col-xl-6 col-lg-6 col-md-7 col-sm-6 col-6 detail">
                                        <p class="student-name-text font-weight-bold">Started On :</p>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-5 col-sm-6 col-6 detail">
                                        <p class="student-name-text detail-text"> <?php echo $startDate;?></p>
                                    </div>    
                                </div>
                                <!-- Completed On -->
                                <div class="row student-details-only">
                                    <div class="col-xl-6 col-lg-6 col-md-7 col-sm-6 col-6 detail">
                                        <p class="student-name-text font-weight-bold">Completed On:</p>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-5 col-sm-6 col-6 detail">
                                        <p class="student-name-text detail-text"> <?php echo $endDate;?></p>
                                    </div>    
                                </div>
                                <!-- Validation ID -->
                                <div class="row student-details-only">
                                    <div class="col-xl-6 col-lg-6 col-md-7 col-sm-6 col-6 detail">
                                        <p class="student-name-text font-weight-bold">Validation ID:</p>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-5 col-sm-6 col-6 detail">
                                        <p class="student-name-text detail-text"> <?php echo $validationID;?></p>
                                    </div>    
                                </div>
                                <!-- Trainer -->
                                <div class="row student-details-only">
                                    <div class="col-xl-6 col-lg-6 col-md-7 col-sm-6 col-6 detail">
                                        <p class="student-name-text font-weight-bold">Trainer :</p>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-5 col-sm-6 col-6 detail">
                                        <p class="student-name-text detail-text"> <?php echo $trainer_name;?></p>
                                    </div>    
                                </div>
                            </div>
                            <!-- Actual Student Detail Div End -->
                        </div>
                        <!-- Student Details End -->
                    </div>
                </div>
            </div>
            <!-- Student Details + Congratulations Div Ends-->

            <!-- Certificate Image Display Div -->
            <div class="col-lg-7 col-md-0 col-lg-7 col-sm-0">
                <div class="certificate-panel text-center">
                    <img src="certificate/certificateImageGenerator.php?validation_id=<?php echo $validationID;?>" alt="CertificateImageGenerator" class="img-thumbnail custom-img-certificate mx-auto" >				
                </div>
                <div class="row mt-5 justify-content-center">
                    <div class="dropdown">
                        <button class="btn btn-success btn-lg dropdown-toggle dropdown-download-certificate" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="false">
                            <i class='fa fa-download mx-auto'></i>Download Cerificate
                        </button>
                        <div class="dropdown-menu dropdrown-menu-div" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item dropdown-menu-item" download="<?php echo $filename; ?>.pdf" href='certificate/certificateDownload.php?validation_id=<?php echo $validationID;?>'>Download Certificate as PDF</button></a>
                            <a class="dropdown-item dropdown-menu-item" download="<?php echo $filename; ?>.png" href="certificate/certificateImageGenerator.php?validation_id=<?php echo $validationID;?>">Download Certificate as Image</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Student Details Div + Certificate Div Start -->

    </div>
</body>
</html>





<?php include('./include/footer.php') ?>


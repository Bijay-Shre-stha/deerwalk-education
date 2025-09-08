
<?php

require_once("../system/application_top.php");

$pgName = 'Faculty-Details';
$id = (int)$_GET['fac-id'];

try {
    $data = $obj->selectJoinWhere("staff", array("staff.full_name", "staff.email", "staff.phone", "staff.description",
    "staff.experties", "staff.education", "staff.experience", "staff.image_name", "staff.linkedin_profile",
    "department.name"), array('staff.id' => $id), "LEFT", "department",
    "department_id", "id");

    if ($data == null)
        die($obj->redirect("./404.php"));

    $subj = $obj->selectAllDataByField('courses', array('subject', 'code', 'sem'), array('teacher' => $id));

    $image_section = '<div class="col-md-12 col-lg-5 mx-md-auto"><div class="card mx-auto border-0">
                           <div class="modal-body card-body d-flex justify-content-center">';

    if(file_exists("../admin/uploads/staff/".$data['image_name'])) {
        $image_section .= '<img id="model-profile" 
                                class="border rounded" alt="member profile" 
                                src=./admin/uploads/staff/'.$data["image_name"].'>';
     } else {

        $image_section .= '<img id="model-profile"
                                class="border rounded" alt="member profile"
                                src="./assets/images/noimg-placeholderII.jpg"/>';
    } 
    
    $image_section .= '</div></div></div>';

    $content_section = '<div class="col-md-7 modal-description-panel"><div><div class="card-body">';

    $experties_list = $obj->stripQuote($data['experties']);
    $content_section .= '<div class="model-name-container">
                        <h4 class="card-title p-0 m-0">' . $data['full_name'];

    if (isset($data['linkedin_profile']) && !empty($data['linkedin_profile'])) {
        $content_section .= ' <a href="' . $data['linkedin_profile'] . '" target="_blank"><i class="fab fa-linkedin"></i></a>';
    }

    $content_section .= '</h4>
                        <h6 class="color-navy pb-3 m-0 arial-medium">' . $data['name'] . '</h6>
                        <span class="feat-line position-absolute"></span>
                    </div>
                    <p>' . $data['description'] . '</p>';



    $content_section .= '<h6 class="arial-medium"><strong>Area of Expertise</strong></h6>
                        <ul id="expertise-list" class="d-flex flex-wrap w-75">';

    if ($experties_list != null) {
        foreach ($experties_list as $value){
            $content_section .= '<li class="ml-4">'.$value.'</li>';
        }
    }else {
        $content_section .= '<li>No Details Avaliable</li>';
    }

    $content_section .= '</ul>';

    $education_list = $obj->getStrippedValue($data["education"]);
    $content_section .= '<h6 class="arial-medium"><strong>Education</strong></h6>
                        <ul class="pointless-list p-0">';

    if ($education_list != null) {
        foreach($education_list as $key => $value){
            $content_section .= '<li>'. $key . '</li>';
        }
    }else {
        $content_section .= '<li>No Details Available.</li>';
    }

    $content_section .= '</ul>';

    $experience_list = $obj->getStrippedValue($data["experience"]);
    $content_section .= '<h6 class="arial-medium"><strong>Experience</strong></h6>
                        <ul class="pointless-list p-0">';

    if ($experience_list != null) {
        foreach ($experience_list as $key => $value) {
            $content_section .= '<li>'.$key.'</li>';
        }
    }else {
        $content_section .= '<li>No Details Found.</li>';
    }

    $content_section .= "</ul>";
    $content_section .= '</div></div></div>';
    $modal_html =  $image_section . $content_section;

    echo json_encode(array("status"=>1, "data"=>$modal_html, "message"=>"Successful Fetch"));
} catch (Exception $exception) {
    echo json_encode(array("status"=>2, "data"=>"<h1>Temporarily Unavaliable.</h1>", "message"=>$exception->getMessage()));
}
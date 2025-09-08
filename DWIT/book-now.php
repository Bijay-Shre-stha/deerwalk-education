<?php
$pgName = 'Book OHS';
include('./include/header.php') ?>

<?php

$data = $obj->getFilterDataByLimit('open_house', array('id', 'session_year', 'session_num', 'session_date_1', 'session_date_2', 'session_time_1', 'session_time_2', 'session_type_1', 'session_type_2', 'max_count_1', 'max_count_2'), '(session_date_1 > CURRENT_DATE() || (session_date_1 = CURRENT_DATE && session_time_1 > CURTIME()) || session_date_2 > CURRENT_DATE() || (session_date_2 = CURRENT_DATE && session_time_2 > CURTIME()) ) && enable = 1', array('session_date_1' => 'asc'));

// $ojb->checkTime($data[0]['session_date2'], $data[0]['session_time_online']);


if($data == null)
    die($obj->redirect("./404.php"));
else{
    $referId = (int)$_POST['session_id'];
    $referId = (int)$_GET['id'];
    if($referId != $data[0]['id'])
        die($obj->redirect("./404.php"));
}

?>
<!--Form Content-->


<div class="container-fluid book-now">
    <div class="row mx-auto">
<!--        Form-->
        <div class="col-md-8">
            <h4 class="r-sub-title text-center">OPEN HOUSE SESSION</h4>
             <!-- <?php echo $obj->numToRoman($data[0]['session_num']); ?> -->
            <form id="register-ohs" action="./ajax/fill-form.php" method="POST">
                <div class="form-group">
                    <label for="fullname" class="form-label"> Full Name: </label><br>
                    <input type="text" id="fullname" name="fullname" required="" class="form-input">
                    <label id="fullname-error" class="error text-danger" for="fullname"></label>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label"> Email: </label><br>
                    <input type="text" id="email" name="email" required="" class="form-input">
                    <label id="email-error" class="error text-danger" for="email"></label>
                </div>
                <div class="form-group">
                    <label for="phone" class="form-label"> Phone No.: </label><br>
                    <input type="text" id="phone" name="phone" required="" class="form-input">
                    <label id="phone-error" class="error text-danger" for="phone"></label>
                </div>
                <div class="form-group">
                    <label for="high_school" class="form-label"> High School: </label><br>
                    <input type="text" id="high_school" name="high_school" required="" class="form-input">
                    <label id="high_school-error" class="error text-danger" for="high_school"></label>
                </div>

                <div class="form-group">
                    <label for="houseType" class="form-label"> Available Dates: </label><br>
                    <select class="form-control" name="houseType" id="houseType">
                            <?php  if($obj->checkTime($data[0]['session_date_1'], $data[0]['session_time_1']) == 1 && ($obj->getBookedUserCount($referId,1) < $data[0]['max_count_1'])): ?>
                                <option value="1">
                                    <?php echo substr($data[0]['session_date_1'], 0 ,10); ?>
                                    (<?php echo ($data[0]['session_type_1'] == 1) ? 'Online' : 'On Campus'; ?>)
                                    <?php echo " | Time: ".date('h:i a',strtotime($data[0]['session_time_1'])); ?>        
                                </option>
                                <!-- displays date - location - time - session 1-->
                            <?php endif; ?>

                            <?php  if($obj->checkTime($data[0]['session_date_2'], $data[0]['session_time_2']) == 1 && ($obj->getBookedUserCount($referId,2) < $data[0]['max_count_2'])): ?>
                                <option value="2">
                                    <?php echo substr($data[0]['session_date_2'], 0 ,10); ?>
                                    (<?php echo ($data[0]['session_type_2'] == 1) ? 'Online' : 'On Campus'; ?>)
                                    <?php echo " | Time: ".date('h:i a',strtotime($data[0]['session_time_2'])); ?>        
                                </option>
                                <!-- displays date - location - time - session 2-->
                            <?php endif; ?>
                    </select>
                    <label id="high_school-error" class="error text-danger" for="high_school"></label>
                </div>

                <div class="form-group">
                    <label for="source" class="form-label">
                        How did you come to know about Deerwalk Institute of Technology?<br>
                        <i><small>Select all that apply</small></i>
                    </label> <br>
                    <table class="table">
                        <tbody><tr>
                            <td class="fntwgt-400"><input type="checkbox" id="dwitStudent" name="source[]" value="DWIT Students"> <label for="dwitStudent">DWIT Students</label> </td>
                            <td class="fntwgt-400"><input type="checkbox" id="dwitStaff" name="source[]" value="DWIT Staff"> <label for="dwitStaff">DWIT Staff</label> </td>
                            <td class="fntwgt-400"><input type="checkbox" id="deerwalkServices" name="source[]" value="Deerwalk Services"> <label for="deerwalkServices">Deerwalk Services</label></td>
                        </tr>
                        <tr>
                            <td class="fntwgt-400"><input type="checkbox" id="deerwalkEmployees" name="source[]" value="Deerwalk Employees"> <label for="deerwalkEmployees">Deerwalk Employees</label></td>
                            <td class="fntwgt-400"><input type="checkbox" id="dwitTraining" name="source[]" value="DWIT Training"> <label for="dwitTraining">DWIT Training</label></td>
                            <td class="fntwgt-400"><input type="checkbox" id="dwitNews" name="source[]" value="DWIT News"> <label for="dwitNews">DWIT News</label></td>
                        </tr>
                        <tr>
                            <td class="fntwgt-400"> <input type="checkbox" id="deerwalkSifal" name="source[]" value="Deerwalk Sifal School"> <label for="deerwalkSifal">Deerwalk Sifal School</label> </td>
                            <td class="fntwgt-400"> <input type="checkbox" id="dlc" name="source[]" value="Deerwalk Learning Center"> <label for="dlc">Deerwalk Learning Center</label> <br> </td>
                            <td class="fntwgt-400"> <input type="checkbox" id="socailMedia" name="source[]" value="Social Media"> <label for="socailMedia">Social Media</label> </td>
                        </tr>
                        <tr>
                            <td class="fntwgt-400"> <input type="checkbox" id="WordOfMouth" name="source[]" value="Word of Mouth"> <label for="WordOfMouth">Word of Mouth</label> </td>
                            <td class="fntwgt-400"> <input type="checkbox" id="it4d" name="source[]" value="IT4D"> <label for="it4d">IT4D</label> </td>
                            <td class="fntwgt-400"> <input type="checkbox" id="jobFair" name="source[]" value="DWIT Job Fair"> <label for="jobFair">DWIT Job Fair</label> </td>
                        </tr>
                        <tr>
                            <td class="fntwgt-400"> <input type="checkbox" name="source[]" value="other" id="otherS" onchange="this.form.other.disabled=!this.checked">  <label for="otherS">Other</label> </td>
                        </tr>
                        </tbody></table>
                    <div class="form-group">
                        <label for="other" class="form-label" > Others: </label><br>
                        <input type="text" id="other" name="other" class="form-input" onchange="validateRequire()" id="other" disabled="disabled">
                        <label id="other-error" class="error text-danger" for="other"></label>            
                    </div>

                    <div class="form-group">
                        <label for="full_name"> Program of Interest: </label><br>
                        
                        <div class="form-check form-check-inline">
                            <input type="radio" name="interest" class="form-check-input ml-2" id="csit" value="1" required="required">
                            <label for="csit" class="form-check-label">CSIT</label>
                            
                            <input type="radio" name="interest" class="form-check-input ml-5" id="bca" value="2">
                            <label for="bca" class="form-check-label">BCA</label>
                            
                            <input type="radio" name="interest" class="form-check-input ml-5" id="both" value="3">
                            <label for="both" class="form-check-label">BOTH</label>
                        </div>
                        <br>
                        <label id="interest-error" class="error text-danger" for="interest"></label>
                    </div>
                </div>
                <input type="hidden" name="house_id" value="<?php echo($referId); ?>">
                <!-- <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                <input type="hidden" name="action" value="validate_captcha"> -->
                <input type="submit" name="formSubmitted" class="btn btn-primary book-btn btn-lg text-center" value="Book Now">
            </form>

        </div>
<!--        Info-->
        <div class="col-md-4">

                <h4 class="r-sub-title text-center ohs-head-2">OPEN HOUSE SESSIONS</h4>
                <p class="lead font-all">Open House are free interactive sessions conducted weekly after
                    board examinations of Grade 12 until the start of the DWIT Aptitude Tests.
                    Prospective students can join the session to learn about different aspects of DWIT,
                    as well as to get their queries related to admissions and life at DWIT answered.
                    These informative sessions also inform the participants about studying Computer Science
                    and its scope.<br><br>
                    Attending DWIT Open House does not compel a student to apply at DWIT. In fact, the
                    students are highly encouraged to attend this session, and get a glimpse of studying
                    Computer Science before deciding on their career paths.</p>
                <hr>
            <h4 class="r-sub-title text-center">OPEN HOUSE SESSIONS <?php echo date('Y'); ?></h4>
            <ul class="font-all">
                <?php 
                    $data = $obj->getAllDataByField('open_house', array('session_num', ' DATE_FORMAT(session_date_1, "%M %d") as year'), 'session_year = '.$data[0]['session_year'], array('session_date_1' => 'desc'));

                    foreach ($data as $d) {
                        $pre = "<li>Open House Session ".$obj->numToRoman($d['session_num'])." - ";
                        echo (strtotime(date('M d')) < strtotime($d['year']))? $pre.$d['year']: $pre."[Booking Closed]";
                    }
                 ?>
            </ul>
            </div>
        </div>
    </div>

</div>

    <script type="text/javascript">
        function validateRequire()
        {

        }
    </script>


<?php include('./include/footer.php') ?>
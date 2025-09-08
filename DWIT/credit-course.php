<?php
$pgName = 'DWIT Credit Courses';
include('./include/header.php');

?>


<!--Page Banner-->
<div class="container-fluid credit-bg">
    <div class="container page-title">
        <h4 class="display-6 text-center r-d-unit-top">DWIT Credit Courses</h4>
    </div>
</div>

<?php 
    $creditCourses = $obj->getAllDataByField('credit_course', array('id', 'code', 'subject','description'), NULL, array('id' => 'ASC'));
?>

<!--Main content-->
<div class="container-fluid">
        <div class="col-md-12" id="detailss">
        <h3 class='semester-header text-center'>DWIT Credit Courses</h3>
        <div class='accordion' id='accordionExample'>
            <?php $count=0; ?>
            <?php foreach($creditCourses as $course): ?>
                <?php $count++; ?>
                <div class="card">
                    <div class="card-header" id="heading1">
                        <h3 class="mb-0">
                        <button class="btn btn-link subject-header collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $count?>" aria-expanded="false" aria-controls="#collapse1">
                            <?php print_r($course['code'])?> : <?php print_r($course['subject'])?>
			            </button> 
                        </h3>
                    </div>
                    <!-- <div id="collapse<?php echo $count?>" class="collapse" aria-labelledby="heading1" data-parent="#accordionExample">
                        <div class="card-body">
                        <?php print_r($course['description'])?>
                        </div>
                    </div> -->
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


<?php include('./include/footer.php') ?>

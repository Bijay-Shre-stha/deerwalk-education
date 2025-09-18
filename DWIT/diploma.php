<?php
$pgName = 'Diploma - Data Science';
include('./include/header.php');

?>


<!--Page Banner-->
<div class="container-fluid diploma-bg">
    <div class="container page-title">
        
        <h4 class="display-6 text-center r-d-unit-top">Diploma in US Healthcare Data Analytics</h4>
    </div>
</div>

<?php 
    $titles = $obj->getAllDataByField('health_diploma', array('id', 'title'), NULL, array("priority" => "ASC"));

 ?>

<!--Main content-->
<div class="container-fluid">
    <div class="row course-row">
        <div class="col-md-3">
            <div class="container">
                <table class="table table-hover year-table">
                    <tbody>
                        <?php foreach($titles as $title): ?>
                        <tr class="row-test year-row" id="<?php echo "title".$title['id'] ?>" onclick="getContent(<?php echo $title['id']; ?>, event)">
                            <th class="text-center year-header"><?php echo $title['title']; ?></th>
                        </tr>
                        <?php endforeach; ?>
                        <!-- <tr class="row-test year-row" onclick="downloadForm()">
                            <th class="text-center year-header">Admission Form</th>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-9" id="detailss">
            
        </div>
    </div>
</div>

<script type="text/javascript">
    getContent(<?php echo $titles[0]['id']; ?>);

    function getContent(id, evt = null)
    {
        console.log("Here" + id);
        if(evt != null){
            rowTest = document.getElementsByClassName("row-test");
            for (i = 0; i < rowTest.length; i++) {
                rowTest[i].className = rowTest[i].className.replace(" active", "");
            }
            evt.currentTarget.className += " active";
        }else{
            document.getElementById("<?php echo "title".$titles[0]['id'] ?>").classList.add('active');
        }

        $.ajax({
            url: "./ajax/newCourseDetail.php",
            type: "post",
            data: {'id': id},
            dataType: "json",
            success: function (response) {
                if (response.status == 1) {
                   $('#detailss').html(response.detail);
                }
            }
        });
    }

    function downloadForm() 
    {
        let link = document.createElement("a");
        link.setAttribute('download', 'Admission_Form_Diploma.pdf');
        link.href = "https://deerwalk.edu.np/DWIT/assets/pdf/registration.pdf";
        document.body.appendChild(link);
        link.click();
        link.remove();
    }

</script>

<?php include('./include./footer.php') ?>

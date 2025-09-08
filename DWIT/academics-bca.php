<?php
$pgName = 'Academics - BCA';
include ('./include/header.php') ?>

<!--Page Banner-->
<div class="container-fluid BCA-bg">
    <div class="container page-title">
        <h4 class="display-6 text-center r-d-unit-top">ACADEMICS - BCA</h4>
    </div>
</div>

<!--Main content-->
<div class="container-fluid">
    <div class="row course-row">
        <div class="col-md-3">
            <div class="container">
                <table class="table table-hover year-table">
                    <tbody>
                        <tr class="row-test year-row" id="firstYear" onclick="getContent(1, event)">
                            <th class="text-center year-header">FRESHMAN YEAR</th>
                        </tr>

                        <tr class="row-test year-row" id="secondYear" onclick="getContent(2, event)">
                            <th class="text-center year-header">SOPHOMORE YEAR</th>
                        </tr>

                        <tr class="row-test year-row" id="thirdYear" onclick="getContent(3, event)">
                            <th class="text-center year-header">JUNIOR YEAR</th>
                        </tr>

                        <tr class="row-test year-row" id="fourthYear" onclick="getContent(4, event)">
                            <th class="text-center year-header">SENIOR YEAR</th>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-9" id="detailss">

        </div>
    </div>
</div>

<script type="text/javascript">
    getContent(1);

    function getContent(year, evt = null) {
        if (evt != null) {
            rowTest = document.getElementsByClassName("row-test");
            for (i = 0; i < rowTest.length; i++) {
                rowTest[i].className = rowTest[i].className.replace(" active", "");
            }
            evt.currentTarget.className += " active";
        } else {
            document.getElementById("firstYear").classList.add('active');
        }

        $.ajax({
            url: "./ajax/courseDetail.php",
            type: "post",
            data: { 'year': year, 'stream': 2 },
            dataType: "json",
            success: function (response) {
                if (response.status == 1) {
                    $('#detailss').html(response.detail);
                }
            }
        });
    }

</script>

<?php include ('./include./footer.php') ?>
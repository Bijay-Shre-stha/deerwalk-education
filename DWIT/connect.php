<?php
$pgName = 'Connect';
$ogTitle = "Deerwalk Institute Of Technology | Connect";
$ogUrl = "http://deerwalk.edu.np/DWIT/connect.php";
$ogDescription = 'Before deciding on joining Deerwalk Institute Technology for undergraduate education, we hope that the students are already well known and familiar about the facilities and platform our institution offers. To facilitate this, we have this section, \'Connect with Students\'. Through this section, you will be able to connect with current DWIT students who may share with you similar home district, secondary school or high school. You can submit the form online and we will find the right person who can provide you the right counselling and advice.';
include('./include/header.php');

$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf-token'] = $token;
?>

<?php echo(Page_finder::get_message()); ?>
<div class="container-fluid campus-bg">
    <div class="container page-title">
        <h4 class="display-6 text-center r-d-unit-top">CONNECT WITH OUR CURRENT STUDENTS</h4>
    </div>
</div>

<!--Content-->

<div class="container-fluid page-desc">
    <p class="lead page-desc-text">Before deciding on joining Deerwalk Institute Technology for undergraduate education, we hope that the students are already well known and familiar about the facilities and platform our institution offers. To facilitate this, we have this section, "Connect with Students". Through this section, you will be able to connect with current DWIT students who may share with you similar home district, secondary school or high school. You can submit the form online and we will find the right person who can provide you the right counselling and advice. Select your schools and district from the drop down menu.</p>
</div>

<div class="container-fluid">
    <h4 class="r-sub-title text-center">FIND CONNECTION</h4>
    <div class="row connect-form">
        <div class="col-md-8 connect-menu">
            <form class="mx-auto form-connect">
                <div class="form-group mx-auto form-connect2">
                    <label for="name" class="form-detail">Your Name</label>
                    <input type="text" name="name" class="form-control form-custom custom-select" placeholder="Enter your Name" id="name">
             
                    <label for="email" class="form-detail">Your Email Address</label>
                    <input type="email" name="email" class="form-control form-custom custom-select" placeholder="Enter Your Email" id="email">
             
                    <label for="districtControlSelect1" class="form-detail">Your Home District</label>
                    <select class="form-control form-custom js-example-responsive" id="districtControlSelect1">
                        <option selected disabled>Choose...</option>
                        <?php include('districts.php'); ?>
                    </select>

                    <label for="schoolControlSelect1" class="form-detail">SEE Appeared School</label>
                    <input type="text" name="school" class="form-control form-custom custom-select" id="schoolControlSelect1" list="suggestSchool" oninput="suggest(this.value, 1)" autocomplete="off" onblur="preventExtra(this.value, 1)" placeholder="Choose...">
                    
                    <div id="suggestSchool" class="form-overlay ">
                    </div>
                        
                    <label for="highSchoolControlSelect1" class="form-detail">High School</label>
                    <input type="text" name="high_school" class="form-control form-custom custom-select" id="highSchoolControlSelect1" list="suggestHighSchool" oninput="suggest(this.value, 2);" autocomplete="off" onblur="preventExtra(this.value, 2)" placeholder="Choose...">
                    
                    <div id="suggestHighSchool" class="form-overlay">
                    </div>

                    <button class="btn btn-default connect-btn" type="button" onclick="findMatch()">CONNECT</button>
                </div>
            </form>
        </div>

        <div class="col-md-4 connect-img">
        </div>
    </div>
</div>
<div id="successMessage" class="alert alert-success text-center mt-4" role="alert" style="display: none;">
  Email sent successfully!
</div>
<div id="errorMessage" class="alert alert-danger text-center mt-4" role="alert" style="display: none;">
  Failed to send email!
</div>

<div class="container-fluid">
    <div class="row student-info" id="suggestedList">
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="connectModal" tabindex="-1" role="dialog" aria-labelledby="connectModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="connectModalLabel">Connect Form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="./ajax/connectWith.php" method="POST">
            <div class="modal-body">
                <div class="form-group">
                    <label for="connectTo">Connect To</label>
                    <input type="text" name="connectTo" class="form-control" value="Full Name" readonly="readonly" id="connectTo">
                </div>
                <div class="form-group">
                    <label for="highSchool">High School</label>
                    <input type="text" name="highSchool" class="form-control" value="High School" disabled="disabled" id="hschool">
                </div>
                <hr>
                <label>Your Query</label>
                <div class="form-group">
                    <input type="email" name="senderEmail" class="form-control" placeholder="Enter your email address">
                </div>
                <div class="form-group">
                    <textarea class="form-control" placeholder="Enter your query here..." rows="4" name="inquery" id="inquery"></textarea>
                </div>
            </div>
            
            <div class="modal-footer">
                <input type="hidden" name="csrf-token" value="<?php echo($token); ?>">
                <input type="hidden" name="studentId" id="studentId">
                <!-- <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response"> -->
                <!-- <input type="hidden" name="action" value="validate_captcha"> -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="submit">Send</button>
            </div>
        </form>
    </div>
  </div>
</div>


<script type="text/javascript">
    let list;
    function connectTo(fullname, id, school)
    {
        $(".modal-body #connectTo").val( fullname );
        $(".modal-body #hschool").val( decodeURI(school) );
        $("#studentId").val( id );
        $('#connectModal').modal('show');
    }

    function suggest(value, type)
    {
        $.ajax({
            url: "./ajax/suggestion.php",
            type: "post",
            data: {'value':value, 'type':type},
            dataType: "json",
            success: function (response) {
                if (response.status == 1) {
                    list = response.detail;
                    if(type == 1)
                        $('#suggestSchool').html(response.detail);
                    else if(type == 2)
                        $('#suggestHighSchool').html(response.detail);
                }
            }
        });
    }

    function preventExtra(value, type)
    {
        if(!list.includes(value))
        {
            let msg = "Not Available";
            if(type==1)
            {
                document.getElementById('schoolControlSelect1').value = msg;
            }else if(type = 2)
            {
                document.getElementById('highSchoolControlSelect1').value = msg;
            }
        }
    }

    function findMatch() {
  let school = document.getElementById('schoolControlSelect1').value;
  let high_school = document.getElementById('highSchoolControlSelect1').value;
  let district = document.getElementById('districtControlSelect1').value;
  let email = document.getElementById('email').value;
  let name = document.getElementById('name').value; // Get the email address from the input field
  $.ajax({
    url: "./ajax/sendEmail.php", // Replace with the correct URL of your PHP script
    type: "post",
    data: { 'school': school, 'high_school': high_school, 'district': district, 'email': email ,'name' : name},
    dataType: "json",
    success: function(response) {
        console.log(response.detail);
        if (response.status == 1) {
            document.getElementById('successMessage').style.display = 'block';
        } else {
            document.getElementById('errorMessage').style.display = 'block';
        }
        }
    });
}


    function showMatch(studentList)
    {
        list = '';
        for(const id in studentList)
        {
            list += '<div class="col-md-4 card-cont">\
            <div class="card student-card mx-auto">\
                <img src="'+ studentList[id].image +'" class="student-img">\
                <div class="student-content">\
                    <h5>' + studentList[id].name + '</h5>\
                    <h6><button class="btn btn-primary" onclick=\'connectTo(\"' + studentList[id].name + '\", \"' + studentList[id].id + '\", \"' + escapeHTML(studentList[id].high_school) + '\")\'>Connect</button></h6>\
                </div>\
            </div>\
        </div>'
        }

        document.getElementById('suggestedList').innerHTML = list;
    }

    function setValue(obj, field)
    {
        if(field == 1)
        {
            $("#schoolControlSelect1").val(obj);
        }else if(field == 2){
            $("#highSchoolControlSelect1").val(obj);
        }

        hideSuggestion(field);
    }

    function hideSuggestion(field)
    {
        if(field == 1)
        {
            $('#suggestSchool').html('');
        }else if(field == 2){
            $('#suggestHighSchool').html('');
        }
    }

    function escapeHTML(str)
    {
      str = str.replace(/"/g, "&quot;");
      str = str.replace(/'/g, "&#039;");
      return str;
    }

</script>

<?php include('./include/footer.php') ?>
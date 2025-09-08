<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");


$getData = $obj->select("department", array("id", "name"));

if (isset($_GET['fid'])) {
    $id = (int)$_GET['fid'];
    $oldData = $obj->getFieldDataById("staff", array("priority", "full_name", "email", "phone", "description", "experties", "education", "experience", "image_name", "type", "department_id","linkedin_profile"), $id);
    $action = "edit";
} else {
    $action = "add";
}

?>

<h2 class="text-center">Add Faculty</h2>

<form action="?fold=actpages&page=act_faculty" id="add-faculty" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name :</label>
        <input type="text" class="form-control" id="name" placeholder="Enter faculty name" name="name"
               value="<?php if (isset($oldData)) echo $oldData['full_name']; ?>">
        <label id="name-error" class="error invalid-feedback" for="name"></label>
    </div>

    <div class="form-group">
        <label for="facEmail">Email :</label>
        <input type="email" class="form-control" id="facEmail" placeholder="Enter faculty email" name="email"
               value="<?php if (isset($oldData)) echo $oldData['email']; ?>">
        <label id="facEmail-error" class="error invalid-feedback" for="facEmail"></label>
    </div>

    <div class="form-group">
        <label for="facPhone">Phone :</label>
        <input type="text" class="form-control" id="facPhone" placeholder="Enter faculty phone" name="phone"
               value="<?php if (isset($oldData)) echo $oldData['phone']; ?>">
        <label id="facPhone-error" class="error invalid-feedback" for="facPhone"></label>
    </div>

    <div class="form-group">
        <label for="facLinkedin">Linkedin :</label>
        <input type="text" class="form-control" id="facLinkedin" placeholder="Enter faculty Linkedin profile" name="linkedin"
               value="<?php if (isset($oldData)) echo $oldData['linkedin_profile']; ?>">
        <label id="facLinkedin-error" class="error invalid-feedback" for="facLinkedin"></label>
    </div>

    <div class="form-group">
        <label for="department">Department:</label>
        <select class="form-control" id="department" name="department">
            <option selected disabled>--Select Department--</option>
            <?php
            while ($row = $getData->fetch()) {
                ?>
                <option value="<?php echo $row['id']; ?>" <?php if (isset($oldData)) {
                    if ($row['id'] == $oldData['department_id']) echo "selected";
                } ?> > <?php echo $row['name']; ?> </option>
            <?php } ?>
        </select>
        <label id="department-error" class="error invalid-feedback" for="department"></label>
    </div>

    <div class="form-group">
        <label for="status">Status:</label>
        <select class="form-control" id="status" name="status">
            <option selected disabled>Select type</option>
            <option value="Present Faculty"
                <?php if (isset($oldData)) {
                    if ($oldData['type'] == "Present Faculty")
                        echo "selected";
                } ?> >Present Faculty
            </option>
            <option value="Ex-Faculty" <?php if (isset($oldData)) {
                if ($oldData['type'] == "Ex-Faculty") echo "selected";
            } ?>>Ex-Faculty
            </option>
        </select>
        <label id="status-error" class="error invalid-feedback" for="status"></label>
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" placeholder="Enter description here..." name="description"
                  rows="3"> <?php if (isset($oldData)) echo $oldData['description']; ?></textarea>
        <label id="description-error" class="error invalid-feedback" for="description"></label>
    </div>

    <div class="form-group">
        <label for="experties">Area of Experties:</label>
        <div id="dynExperties">
            <?php if(isset($oldData)){ $expertiesList = $obj->stripQuote($oldData['experties']);}else{ $expertiesList = [];} ?>
            
            <?php if($expertiesList == [] || $expertiesList == false || $expertiesList == null) { ?>
                <input type="text" class="form-control" id="experties" placeholder="Enter area of Experties" name="experties[]" value="">
            <?php }else{ foreach($expertiesList as $value):?>
                        <input type="text" class="form-control" placeholder="Enter area of Experties" name="experties[]" value="<?php echo($value); ?>">
                    <?php endforeach; ?>
            <?php } ?>
        </div>
        <br>
        <button type="button" class="btn btn-success" onclick="addExpertieField()">Add More</button>
        <label id="experties-error" class="error invalid-feedback" for="experties"></label>
    </div>
    <br>
    
<!-- new-------------------------------------------------------start -->
        <div class="form-group">
        <div class="form-row">
            <div class="col-md-8">
                <label for="education">Education</label>
            </div>
            <div class="col-md-4">
                <label for="eduDate">Date : (Start Date - End Date)</label>
            </div>
        </div>

        <div id="dynEducation">
            <?php if(isset($oldData)){ $educationList = $obj->getStrippedValue($oldData['education']);}else{ $educationList = [];} ?>

            <?php if($educationList == [] || $educationList == false || $educationList == null){ ?>
                <div class="form-row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="education" placeholder="Enter educational institute name" name="education[]" value="">
                    </div>
                    
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="eduDate" placeholder="Start Date - End Date" name="eduDate[]" value="null">
                    </div>
                </div>
            <?php }else{ foreach($educationList as $org => $dte):?>
                <div class="form-row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="education" placeholder="Enter educational institute name" name="education[]" value="<?php echo($org); ?>">
                    </div>
                    
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="eduDate" placeholder="Start Date - End Date" name="eduDate[]" value="<?php echo($dte); ?>">
                    </div>
                </div>
            <?php endforeach; } ?>
        </div>
        
            <button type="button" class="btn btn-success" onclick="addEducationField()">Add More</button>
    </div>
<!-- new end----------------------------------------------------------- -->

    <br>
    <div class="form-group">
        <div class="form-row">
            <div class="col-md-8">
                <label for="experience">Experience</label>
            </div>
            <div class="col-md-4">
                <label for="expDate">Date : (Start Date - End Date)</label>
            </div>
        </div>

        <div id="dynExperience">
            <?php if(isset($oldData)){ $experienceList = $obj->getStrippedValue($oldData['experience']);}else{ $experienceList = [];} ?>

            <?php if($experienceList == [] || $experienceList == false || $experienceList == null){ ?>
                <div class="form-row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="experience" placeholder="Enter workplace name" name="experience[]" value="">
                    </div>
                    
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="expDate" placeholder="Start Date - End Date" name="expDate[]" value="null">
                    </div>
                </div>
            <?php }else{ foreach($experienceList as $org => $dte):?>
                <div class="form-row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="experience" placeholder="Enter workplace name" name="experience[]" value="<?php echo($org); ?>">
                    </div>
                    
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="expDate" placeholder="Start Date - End Date" name="expDate[]" value="<?php echo($dte); ?>">
                    </div>
                </div>
            <?php endforeach; } ?>
        </div>

            <button type="button" class="btn btn-success" onclick="addExperienceField()">Add More</button>
    </div>
    <br>
    <div class="form-group">
        <label for="photo">Photo:</label>
        <input type="file" class="form-control" id="photo" name="photo" <?php if (!isset($oldData)) echo "required"; ?>>
        <label id="photo-error" class="error invalid-feedback" for="photo"></label>
        <?php if (isset($oldData)): ?>
            <p style="color: red;">*Select New Image only to change the previous image</p>
            <img src="uploads/staff/<?php echo $oldData['image_name']; ?>" alt="faculty" width=100
                 style="margin-top: 15px;">
            <p style="color: green;"><u>Previous Image</u></p>
        <?php endif ?>
    </div>
    <br>
    <div class="form-group">
        <label for="priority">Priority :</label>
        <input type="number" class="form-control" id="priority" placeholder="Sort Priority" name="priority"
               value="<?php if (isset($oldData)) echo $oldData['priority']; ?>">
        <label id="priority-error" class="error invalid-feedback" for="prioritys"></label>
    </div>

    <?php if (isset($oldData)) { ?><input type="hidden" name="id" value="<?php echo $id; ?>"><?php } ?>
    <input type="hidden" name="action" value="<?php echo $action; ?>">

    <?php if ($action == "edit") { ?>
        <script type="text/javascript">
            document.write("<button type=\"submit\" name=\"formSubmitted\" class=\"btn btn-primary\">Update</button>");
        </script>
    <?php }else{ ?>
        <script type="text/javascript">
            document.write("<button type=\"submit\" name=\"formSubmitted\" class=\"btn btn-primary\">Save</button>");
        </script>
    <?php } ?>

    <noscript>
        <p style="color: red;"><b><i>Please enable JavaScript to continue</i></b>
        <p>
    </noscript>
</form>

<script type="text/javascript">
    function addExpertieField()
    {
        console.log("here");
        let input = document.createElement("input");
        input.type = "text";
        input.classList.add("form-control");
        input.placeholder = "Enter area of Experties";
        input.name = "experties[]";

        document.getElementById("dynExperties").appendChild(input);
    }

    // function addEducationField()
    // {

    //     let input = document.createElement("input");
    //     input.type = "text";
    //     input.classList.add("form-control");
    //     input.placeholder = "Enter educational institute name";
    //     input.name = "education[]";

    //     let inp = document.createElement("input");
    //     inp.type = "text";
    //     inp.classList.add("form-control");
    //     inp.placeholder = "Start Date - End Date";
    //     inp.value = "null";
    //     inp.name = "eduDate[]";

    //     document.getElementById("dynEducation").appendChild(input);
    //     document.getElementById("dynEduDate").appendChild(inp);
    // }

    function addExperienceField()
    {
        let input = document.createElement("input");
        input.type = "text";
        input.classList.add("form-control");
        input.placeholder = "Enter workplace name";
        input.name = "experience[]";

        let inp = document.createElement("input");
        inp.type = "text";
        inp.classList.add("form-control");
        inp.placeholder = "Start Date - End Date";
        inp.value = "null";
        inp.name = "expDate[]";

        let row = setCommon(input, inp);
        document.getElementById("dynExperience").appendChild(row);
    }

    function addEducationField()
    {
        let input = document.createElement("input");
        input.type = "text";
        input.classList.add("form-control");
        input.placeholder = "Enter educational institute name";
        input.name = "education[]";

        let inp = document.createElement("input");
        inp.type = "text";
        inp.classList.add("form-control");
        inp.placeholder = "Start Date - End Date";
        inp.value = "null";
        inp.name = "eduDate[]";

        let row = setCommon(input, inp);
        document.getElementById("dynEducation").appendChild(row);
    }

    function setCommon(input, inp)
    {
        let row = document.createElement("div");
        row.classList.add("form-row");

        let col1 = document.createElement("div") ;
        col1.classList.add("col-md-8");

        let col2 = document.createElement("div") ;
        col2.classList.add("col-md-4");

        col1.appendChild(input);
        col2.appendChild(inp);

        row.appendChild(col1);
        row.appendChild(col2);

        return row;
    }


</script>
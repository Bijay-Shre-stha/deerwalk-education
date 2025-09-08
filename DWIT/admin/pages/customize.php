<?php 

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

?>

<div class="row justify-content-center mt-5">
	<div class="col-3 custom-box bg-info">
		<p><a href="index.php?page=add-eligibility&fold=form&row_id=1">Eligibility</a></p>
	</div>

	<div class="col-3 custom-box bg-danger">
		<p><a href="index.php?page=add-eligibility&fold=form&row_id=2">Document Required</a></p>
	</div>

	<div class="col-3 custom-box bg-success">
		<p><a href="index.php?page=add-eligibility&fold=form&row_id=3">Key Dates</a></p>
	</div>
</div>

<div class="row justify-content-center mt-5">
	<div class="col-3 custom-box bg-secondary">
		<p><a href="index.php?page=background">Background Picture</a></p>
	</div>

	<div class="col-3 custom-box bg-success">
		<p><a href="index.php?page=prospectus">Prospectus</a></p>
	</div>

	<div class="col-3 custom-box bg-info">
		<p><a href="index.php?page=healthDiploma">Diploma in Data Analytics</a></p>
	</div>
</div>

<div class="row justify-content-center mt-5">
	<div class="col-3 custom-box bg-success">
		<p><a href="index.php?page=creditCourse">Credit Course</a></p>
	</div>

	<div class="col-3 custom-box bg-danger">
		<p><a href="index.php?page=powerWorkshop">Power Workshop</a></p>
	</div>

	<div class="col-3 custom-box bg-secondary">
		<p><a href="index.php?page=events">Calendar</a></p>
	</div>
</div>

<div class="row justify-content-center mt-5">
	<div class="col-3 custom-box bg-secondary">
		<p><a href="index.php?page=trainer">Trainer</a></p>
	</div>
	<div class="col-3 custom-box bg-info">
		<p><a href="index.php?page=workshopStudent">Workshop Students</a></p>
	</div>
	<div class="col-3 custom-box bg-success">
		<p><a href="index.php?page=workshop">Workshop</a></p>
	</div>
</div>
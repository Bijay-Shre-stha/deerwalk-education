<?php

$url = explode("/", $_SERVER['REQUEST_URI']);
$url = strstr(end($url), ".", true);

if ($_SESSION['userPrivilege'] != "admin" && $url = "index")
    header("location:../index.php?page=404");
elseif ($_SESSION['userPrivilege'] != "admin" && $url != "index")
    header("location:login.php");

$admission_section = array(
						1 => 'Eligibility',
						2 => 'Document Required',
						3 => 'Key Dates'
					);

if(isset($_GET['row_id']))
{
	$id = (int) $_GET['row_id'];
	$avb_row = array(1, 2, 3);
	if(in_array($id, $avb_row))
	{
		$formType = $admission_section[$id];
		$oldData = $obj->getFieldDataById("admission_detail", array("csit", "bca", "common"), $id);
	}else{
		die("Cannot Proceed Further");
	}
}else{
	die("Cannot Proceed Further");
}

?>


<h2 class="text-center"><?php echo "Edit " . $formType; ?></h2>

<form action="?fold=actpages&page=act_admission" id="add-admission" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="csit">CSIT:</label>
        <textarea class="form-control cust-editor" id="csit" placeholder="Enter content here..." name="csit" rows="10"
                  required="required"><?php echo $oldData['csit']; ?></textarea>
        <label id="csit-error" class="error invalid-feedback" for="csit"></label>
    </div>

    <div class="form-group">
        <label for="bca">BCA:</label>
        <textarea class="form-control cust-editor" id="bca" placeholder="Enter content here..." name="bca" rows="10"
                  required="required"><?php echo $oldData['bca']; ?></textarea>
        <label id="bca-error" class="error invalid-feedback" for="bca"></label>
    </div>

    <div class="form-group">
        <label for="common">Common:</label>
        <textarea class="form-control cust-editor" id="common" placeholder="Enter content here..." name="common" rows="10"
                  required="required"><?php echo $oldData['common']; ?></textarea>
        <label id="common-error" class="error invalid-feedback" for="common"></label>
    </div>

    <?php if (isset($oldData)) { ?><input type="hidden" name="id" value="<?php echo $id; ?>"><?php } ?>

    <script type="text/javascript">
        document.write("<button type=\"submit\" name=\"formSubmitted\" class=\"btn btn-primary\">Update</button>");
    </script>
    
    <noscript>
        <p style="color: red;">
        	<b><i>Please enable JavaScript to continue</i></b>
        <p>
    </noscript>
</form>


<script type="text/javascript">

</script>